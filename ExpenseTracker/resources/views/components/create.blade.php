<form method="POST" action="/store" enctype="multipart/form-data">
    @csrf
    <div>
        <h3 class="text-2xl">
            <div class="relative bg-gray-50 border-2 border-gray-200 m-4 rounded-lg">
                <div class="flex space-x-20 place-content-center">
                    <div class="my-8">
                        <label class="sr-only" for="category">Category</label>
                        <select class="border border-black rounded p-2 w-full" name="category">
                            <option value="Food">Food</option>
                            <option value="Transportation">Transportation</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Miscellaneous">Miscellaneous</option>
                        </select>
                    </div>
                    <div class="my-8">
                        <label class="sr-only" for="amount">Amount</label>
                        <input type="decimal" class="border border-black rounded p-2 w-full" name="amount" placeholder="Amount" value="{{old('amount')}}">
                        @error('amount')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="my-8">
                        <label class="sr-only" for="date">Date</label>
                        <input type="date" class="border border-black rounded p-2 w-full" name="date" placeholder="Date" value="{{old('date')}}">
                        @error('date')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="my-8">
                        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Add
                            expense</button>
                    </div>
                </div>
            </div>
        </h3>
    </div>
</form>