<?php

namespace App\Jobs;

use App\Models\Penalty;
use App\Models\PenaltyType;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApplyPenaltyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = now();
        $todayStart = $now->copy()->startOfDay();

        $reservations = Reservation::where('status', 'to_return')
            ->whereNotNull('claimed_at')
            ->where(function ($query) use ($todayStart) {
                $query->whereNull('last_penalized_at')
                      ->orWhere('last_penalized_at', '<', $todayStart);
            })
            ->whereHas('user.profile')
            ->with('user.profile')
            ->get();

        foreach ($reservations as $reservation) {
            $dueDate = Carbon::parse($reservation->due_date);

            if ($dueDate->lt($now)) {
                $profile = $reservation->user->profile;

                if (!$profile) {
                    Log::warning("Profile not found for user ID: {$reservation->user_id}");
                    continue;
                }

                $penaltyType = PenaltyType::where('name', 'Late Return')->first();

                if (!$penaltyType) {
                    Log::warning("Penalty type 'Late Return' not found.");
                    continue;
                }

                $penaltyAmount = $penaltyType->amount;

                DB::beginTransaction();

                try {
                    $profile->penalty += $penaltyAmount;
                    $profile->save();

                    $newDueDate = $dueDate->copy()->addDay();
                    $reservation->update([
                        'last_penalized_at' => $now,
                        'due_date' => $newDueDate,
                    ]);

                    Penalty::create([
                        'profile_id' => $profile->id,
                        'book_id' => $reservation->book_id,
                        'amount' => $penaltyAmount,
                        'applied_at' => $now,
                        'penalty_type_id' => $penaltyType->id,
                    ]);

                    DB::commit();

                    Log::info("Reservation ID {$reservation->id} penalized. ₱{$penaltyAmount} added. New due date: {$newDueDate->toDateString()}");
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error("Failed to apply penalty for reservation ID {$reservation->id}: {$e->getMessage()}");
                }
            }
        }
    }
}
