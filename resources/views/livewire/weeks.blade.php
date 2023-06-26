<div>
    <form wire:submit.prevent="changeMonth" class="flex items-center">
        <select wire:model="selectedDate" id="month" name="month" class="text-lg my-4">
            <?php
            // Generate the next 12 months
            $options = '';
            for ($i = 0; $i < 12; $i++) {
                $timestamp = strtotime("+$i months");
                $monthValue = date('Y-m', $timestamp);
                $monthName = date('F Y', $timestamp);
                $selected = $monthValue == date('m', strtotime($this->selectedDate)) ? 'selected' : '';
                $options .= "<option value=\"$monthValue\" $selected>$monthName</option>";
            }
            echo $options;
            ?>
        </select>
    </form>

    <h2 class="text-2xl font-semibold mb-4"></h2>

    <div class="flex w-full rounded-md bg-white">

        <!-- Previous Button -->
        <button wire:click.prevent="{{ $currentPage === 1 ? 'previousMonth' : 'previousPage' }}"
                class="px-3 py-2 {{ $currentPage === 1 ? 'bg-gray-500 text-gray-800' : 'bg-blue-500 text-white' }} focus:outline-none">
            <i class="fa-solid fa-caret-left"></i>
        </button>

        @foreach ($weeks as $week)
            @if ($loop->index === $currentPage - 1)
                <div class="week gap-y-4 w-full mx-5 flex flex-wrap space-x-2">
                    @foreach ($week as $day)
                        @if ($day)
                            @php
                                $dayOfWeek = strtolower(substr($day['dayOfWeek'], 0, 3));
                                $isWorkDay = in_array($dayOfWeek, $workDays);
                                $buttonClass = $isWorkDay ? 'hover:border-2 hover:border-blue-300 bg-white-200 border border-gray-300 text-gray-300' : 'bg-gray-300 text-gray-100';
                                $textClass =  $isWorkDay ? '' : ' text-gray-100';
                            @endphp
                            <button wire:click.prevent="outputDate('{{ $selectedDate }}-{{ $day['day'] }}')"
                                    class="font-mono text-gray-800 rounded-lg px-4 py-2 flex flex-col items-center {{ $buttonClass }}">
                                <span class="text-sm capitalize text-lowercase font-bold">{{ strtolower(substr($day['dayOfWeek'], 0, 3)) }}</span>
                                <span class="{{$textClass}} text-2xl">{{ $day['day'] }}</span>
                            </button>

                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach

        <!-- Next Button -->
        <button wire:click.prevent="{{ $currentPage === count($weeks) ? 'nextMonth' : 'nextPage' }}"
                class="px-3 py-2 {{ $currentPage === count($weeks) ? 'bg-gray-500 text-gray-800' : 'bg-blue-500 text-white' }} focus:outline-none">
                <i class="fa-solid fa-caret-right"></i>
        </button>
    </div>
</div>
