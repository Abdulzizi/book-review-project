@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl font-bold">Add Review for {{ $book->title }}</h1>

    <form method="POST" action="{{ route('books.reviews.store', $book->id) }}" class="space-y-6">
        @csrf

        <!-- Rating Field -->
        <div>
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
            <select id="rating" name="rating" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" disabled selected>Select rating</option>
                @foreach (range(1, 5) as $rating)
                    <option value="{{ $rating }}">{{ $rating }}</option>
                @endforeach
            </select>
            @error('rating')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Review Field -->
        <div>
            <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
            <textarea id="review" name="review" rows="4" required class="input" placeholder="Write your review here...">{{ old('review') }}</textarea>
            @error('review')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex gap-5 items-center">
            <button type="submit" class="btn">
                Add Review
            </button>
            <a href="{{ url()->previous() }}" class="reset-link">Back</a>
        </div>
    </form>
@endsection
