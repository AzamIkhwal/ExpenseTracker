<x-layout>

@include('components.pie-chart')
@include('components.create')

    <div class="grid grid-cols-2 row-auto-max">
        <div class="bg-gray-50 border-2 border-gray-200 m-4 rounded-lg">
            <header class="text-center">
                <h2 class="text-3xl font-bold uppercase mb-1">
                    Daily Report
                </h2>
            </header>
            
            <div class="flex justify-center">
                <h3 class="text-xl">
                    <div>
    
                        <form action="/index" method="POST">
                            @csrf
                            <label for="filter_date">Daily expense on:</label>
                            <input type="date" class="border border-black rounded p-2" id="filter_date" name="filter_date"
                                value="{{ old('filter_date', $filterDate) }}" />
                            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" type="submit"> Submit
                            </button>
                        </form>
                        @unless(count($dailyReportData) == 0)
                        
                        <table class="border-separate border-spacing-0">
                            <tbody>

                                @foreach($dailyReportData as $data)
                                <tr class="@switch($data->category)
                                @case('Food')
                                    bg-red-200
                                    @break
                                @case('Entertainment')
                                    bg-green-200
                                    @break
                                @case('Transportation')
                                    bg-blue-200
                                    @break
                                @case('Utilities')
                                    bg-yellow-200
                                    @break
                                @case('Miscellaneous')
                                    bg-purple-200
                                    @break
                                @endswitch">
                                <td>{{$data->category}}</td>
                                <td>RM{{$data->amount}}</td>
                                <td class="border border-l-black">
                                    <form method="POST" action="/delete/{{$data->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"><i class="fas fa-times"></i>
                                    </button>
                                </form>
                                </td>
                            </tr> 
                            @endforeach
                              <tr>
                                <td>Total</td>
                                <td>RM{{$dailyReportData->pluck('amount')->sum()}}</td>
                              </tr>
                            </tbody>
                          </table>
    
                        @else
                        <p>No expenses found</p>
                        @endunless
    
                    </div>
                </h3>
            </div>
        </div>
    
        <div class="bg-gray-50 border-2 border-gray-200 m-4 rounded-lg">
            <header class="text-center">
                <h2 class="text-3xl font-bold uppercase mb-1">
                    Monthly Report
                </h2>
            </header>
            <div class="ml-6 mb-6">
                <h3 class="text-2xl">
                    <div class="flex justify-center">
                        <table class="border-separate border-spacing-2">
                            <thead>
                              <tr>
                                <th class="border border-slate-600">Category</th>
                                <th class="border border-slate-600">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="border border-slate-700 bg-red-200">Food</td>
                                <td class="border border-slate-700 bg-red-200">RM{{$totalFood}}</td>
                              </tr>
                              <tr>
                                <td class="border border-slate-700 bg-green-200">Entertainment</td>
                                <td class="border border-slate-700 bg-green-200">RM{{$totalEntertainment}}</td>
                              </tr>
                              <tr>
                                <td class="border border-slate-700 bg-blue-200">Transportation</td>
                                <td class="border border-slate-700 bg-blue-200">RM{{$totalTransportation}}</td>
                              </tr>
                              <tr>
                                <td class="border border-slate-700 bg-yellow-200">Utilities</td>
                                <td class="border border-slate-700 bg-yellow-200">RM{{$totalUtilities}}</td>
                              </tr>
                              <tr>
                                <td class="border border-slate-700 bg-purple-200">Miscellaneous</td>
                                <td class="border border-slate-700 bg-purple-200">RM{{$totalMiscellaneous}}</td>
                              </tr>
                              <tr>
                                <td class="border-none"></td>
                                <td class="border border-slate-700">RM{{$monthlyReportData->pluck('amount')->sum()}}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </h3>
            </div>
        </div>
    </div>
</x-layout>