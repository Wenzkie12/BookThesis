 @if($status === 'to_claim')
                                    <form action="{{ route('staff.reservations.claim', $reservation) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <x-primary-button class="text-xs px-3 py-1">
                                            Mark Claimed
                                        </x-primary-button>
                                    </form>
                                @elseif($status === 'to_return')
                                    @if($reservation->lost_declared && $reservation->lost_status === 'pending')
                                        <form action="{{ route('staff.reservations.acceptLost', $reservation) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <x-primary-button class="text-xs px-3 py-1">
                                                Accept Lost
                                            </x-primary-button>
                                        </form>
                                        <form action="{{ route('staff.reservations.denyLost', $reservation) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <x-primary-button class="text-xs px-3 py-1">
                                                Deny Lost
                                            </x-primary-button>
                                        </form>
                                    @else
                                        <form action="{{ route('staff.reservations.complete', $reservation) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <x-primary-button class="text-xs px-3 py-1">
                                                Mark Returned
                                            </x-primary-button>
                                        </form>

                                        @if($reservation->lost_status)
                                            <span class="text-xs italic block mt-1">
                                                {{ ucfirst($reservation->lost_status) }}
                                            </span>
                                        @endif
                                    @endif
                                @else
                                    <span class="text-xs italic">No actions</span>
                                @endif