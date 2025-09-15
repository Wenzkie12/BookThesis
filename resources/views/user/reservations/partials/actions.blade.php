@if ($status === 'to_claim')
    <div class="flex flex-col sm:flex-row sm:items-start gap-2">

        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Cancel this reservation?')">
            @csrf
            @method('PATCH')
            <x-danger-button class="bg-red-600 hover:bg-red-500 text-sm px-3 py-1">
                Cancel
            </x-danger-button>
        </form>

        @if (!$reservation->pickup_date_edited)
            <form action="{{ route('user.reservations.editPickupDate', $reservation->id) }}" method="POST" onsubmit="return confirm('Update pickup date?')" class="flex flex-col sm:flex-row gap-2">
                @csrf
                @method('PATCH')
                <input 
                    type="date" 
                    name="pickup_date" 
                    class="pickup-date-input border rounded px-2 py-1 text-sm"
                    min="{{ now()->format('Y-m-d') }}" 
                    value="{{ $reservation->pickup_date->format('Y-m-d') }}"
                    required
                />
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-1 rounded">
                    Update Pickup Date
                </button>
            </form>
        @else
            <span class="text-xs italic text-gray-400 block mt-1">Pickup date already edited</span>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInputs = document.querySelectorAll('.pickup-date-input');
            dateInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const selectedDate = new Date(this.value);
                    const day = selectedDate.getDay();
                    if ([0, 5, 6].includes(day)) {
                        alert('You cannot select Friday, Saturday, or Sunday as the pickup date.');
                        this.value = '';
                    }
                });
            });
        });
    </script>
@elseif ($status === 'to_return')
    <form action="{{ route('user.reservations.declareLost', $reservation->id) }}" method="POST" onsubmit="return confirm('Declare this book as lost?')">
        @csrf
        @method('PATCH')
        <x-danger-button class="bg-red-600 hover:bg-red-500 text-sm px-3 py-1">
            Declare Lost
        </x-danger-button>
    </form>
@else
    <span class="text-gray-400 text-xs italic">No actions</span>
@endif
