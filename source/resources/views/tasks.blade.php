<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tasks List</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>


    </head>
    <body class="antialiased">
        <h4 class="text-center py-2">weekly task schedule</h4>
        <div class="flex justify-center min-h-screen sm:items-center sm:pt-1">
            <div class="max-w-8xl flex flex-row mx-auto">
                
                @foreach($developers as $developer)
                    <div class="flex flex-col px-2 justify-between border  divide-y divide-dashed">
                        <span class="text-center">
                            {{ $developer->name }}
                        </span>
                        
                        <div class="flex flex-row justify-between font-bold text-sm">
                            <span class="w-[80px]"> 
                                Task Name
                            </span>
                            <span class="w-[20px] text-center">
                                Lv
                            </span>
                            <span class="w-[40px] text-center">
                                Est.
                            </span>
                            <span class="w-[50px] text-center"> 
                                Sp.
                            </span>
                            <span class="w-[60px] text-right"> 
                                Total
                            </span>
                        </div>
                        @php $totalHour = 0; @endphp
                        @foreach($developer->tasks as $task)
                            <div class="flex flex-row justify-between items-center py-1 font-normal text-sm">
                                <span class="w-[80px]"> 
                                    {{ $task->name }}
                                </span>
                                <span class="w-[20px] text-center">
                                    {{ $task->level }}
                                </span>
                                <span class="w-[40px] text-center">
                                    {{ $task->estimated_duration }}
                                </span>
                                <span class="w-[50px] text-center"> 
                                    {{ gmdate('H:i', floor($task->expected_duration * 3600)) }}
                                </span>
                                <span class="w-[60px] text-right"> 
                                    @php $totalHour += $task->expected_duration @endphp
                                    {{ \Carbon\CarbonInterval::seconds($totalHour * 3600)->cascade()->forHumans(['short' => true]) }}
                                </span>
                            </div>
                        @endforeach
                        <div class="text-right items-center py-1 font-normal text-sm mb-4">
                            Total: {{ number_format(round($totalHour) / 45, 2) . ' week' }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
