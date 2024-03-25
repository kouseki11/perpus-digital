<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($book->title) }} - {{ __('Book Detail') }}
            </h2>
            <a href="{{ route('books.index') }}"
                class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><svg
                    class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg></a>
        </div>
    </x-slot>

    <div
        class="flex m-5 md:m-10 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col md:flex-row gap-5 p-5 md:p-10">
            <img src="{{ asset($book->cover) }}" alt="{{ $book->title }} cover image"
                class="md:h-96 md:w-96 h-full w-full ">

            <ul class="space-y-1 py-2">
                <li class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $book->title }}
                </li>
                <li>
                    <strong>Author :</strong> {{ $book->author }}
                </li>
                <li>
                    <strong>Publisher :</strong> {{ $book->publisher }}
                </li>
                <li>
                    <strong>Category :</strong>
                    @if ($book->category->isEmpty())
                        Not set category
                    @else
                        @foreach ($book->category as $category)
                            {{ $category->name }}
                        @endforeach
                    @endif
                </li>
                <li>
                    <strong>Release Date :</strong> {{ $book->release_date }}
                </li>
                <li>
                    {{ $book->synopsis }}
                </li>
                <li class="flex flex-wrap justify-center gap-4">
                    @if (Auth::user()->hasRole('loaner'))
                        <form method="post" action="{{ route('loans.store', $book->id) }}">
                            @csrf
                            <button type="submit"
                                {{ $loans == null || $loans->status == 'returned' ? '' : 'disabled' }}
                                class="{{ $loans == null || $loans->status == 'returned' ? 'text-white focus:ring-4 bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center ' : 'text-white focus:ring-4 bg-blue-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center' }}">
                                Loan
                            </button>
                        </form>
                        @if ($loans)
                            @if ($loans->status == 'loaned')
                                <form method="POST" action="{{ route('loans.update', $loans->id) }}">
                                    @csrf
                                    @method('put')
                                    <button type="submit"
                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        Return
                                    </button>
                                </form>
                            @endif
                        @endif
                        <button type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Add to collection
                        </button>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <div class="flex flex-col md:flex-row m-5 md:m-10 space-y-5 md:space-y-0 gap-3">
        @if(Auth::user()->hasRole('loaner') && $loans)
          @if($reviewee == null)
        <div
            class="w-full md:w-1/2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form class="p-5 space-y-6" method="POST" action="{{ route('reviews.store', $book->id) }}"
                id="bookReviewForm">
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Submit a Book Review</h5>
                <div>
                    <label for="bookTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                        Title</label>
                    <input disabled value="{{ $book->title }}" type="text" name="bookTitle" id="bookTitle"
                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Enter the book title" required />
                </div>
                <div>
                    <label for="review" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        Review</label>
                    <textarea name="review" id="review" placeholder="Write your review here..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required></textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                    <div class="flex items-center space-x-2">
                        <input type="radio" id="rating1" name="rating" value="1" required>
                        <label for="rating1">1</label>
                        <input type="radio" id="rating2" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input type="radio" id="rating3" name="rating" value="3">
                        <label for="rating3">3</label>
                        <input type="radio" id="rating4" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input type="radio" id="rating5" name="rating" value="5">
                        <label for="rating5">5</label>
                    </div>
                </div>
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit
                    Review</button>
            </form>
        </div>
        @else
        <div
        class="w-full md:w-1/2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <form class="p-5 space-y-6" method="POST" action="{{ route('reviews.update', $reviewee->id) }}"
            id="bookReviewForm">
            @csrf
            @method('put')
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Edit a Book Review</h5>
            <div>
                <label for="bookTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book
                    Title</label>
                <input disabled value="{{ $book->title }}" type="text" name="bookTitle" id="bookTitle"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Enter the book title" required />
            </div>
            <div>
                <label for="review" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                    Review</label>
                <textarea name="review" id="review" placeholder="Write your review here..."
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required>{{ $reviewee->review }}</textarea>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                <div class="flex items-center space-x-2">
                    <input type="radio" id="rating1" name="rating" value="1" {{ $reviewee->rating == '1' ? 'checked' : '' }} required>
                    <label for="rating1">1</label>
                    <input type="radio" id="rating2" name="rating" value="2" {{ $reviewee->rating == '2' ? 'checked' : '' }}>
                    <label for="rating2">2</label>
                    <input type="radio" id="rating3" name="rating" value="3" {{ $reviewee->rating == '3' ? 'checked' : '' }}>
                    <label for="rating3">3</label>
                    <input type="radio" id="rating4" name="rating" value="4" {{ $reviewee->rating == '4' ? 'checked' : '' }}>
                    <label for="rating4">4</label>
                    <input type="radio" id="rating5" name="rating" value="5" {{ $reviewee->rating == '5' ? 'checked' : '' }}>
                    <label for="rating5">5</label>
                </div>
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit Review</button>
        </form>
    </div>
        @endif
        @endif

        <div
            class="w-full md:w-1/2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="text-bold text-xl mt-10 mx-5">
                <p>Users Review</p>
            </div>
            <div id="responseCard" class="p-5 space-y-4 max-h-80 overflow-hidden hover:overflow-auto">
                @foreach ($reviews as $review)
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset($book->cover) }}" alt="Profile Photo" class="w-12 h-12 rounded-full">
                        <div>
                            <h5 class="text-lg font-medium text-gray-900 dark:text-white">{{ $review->user->name }}
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-gray-300">Reviewed on
                                {{ date('F d, Y', strtotime($review->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="overflow-hidden overflow-ellipsis max-h-40">
                        <p class="text-gray-700 dark:text-gray-300">{{ $review->review }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500 dark:text-gray-300">Rating:</span>
                        <span class="text-blue-700 dark:text-blue-500">{{ $review->rating }}/5</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</x-app-layout>
