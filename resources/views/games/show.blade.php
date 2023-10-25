@extends('layouts.app')
@section('title', 'GameXChange | ' . $game->name)
@section('content')
<div class="container bg-darker d-flex py-5 px-5" style="margin-top:8vh; min-height:100vh;">
    <div class="me-5" style="width:25%">
        <div>
            <img src="{{ asset('Asset/games/' . $game->image) }}" class="w-100 rounded-3" alt="Alternate Text" />
        </div>
        <div class="text-center fs-4 mt-3">
            @php
                // Assuming you have a Game model instance called $game
                $averageRating = optional($game->ratings->first())->average_rating ?? 0;
            @endphp
            <i class="bi bi-star-fill" style="">{{ number_format($averageRating, 2) }}</i>
        </div>
        <div class="my-3 text-center">
            <h3>Rp.{{ number_format($game->price, 0, ',', '.') }}</h3>
        </div>
        <div class="d-flex justify-content-center flex-column align-items-center">
            @auth
                @if (auth()->user()->role === 'customer')
                    <form method="post" class="w-100" action="{{ route('cart.store', ['game_id' => $game->id, 'user_id' => auth()->user()->id, 'quantity' => 1]) }}">
                        @csrf
                        <button type="submit" class="mb-3 fs-4 hover-effect rounded-3 border-0 w-25 m-auto py-2 bg-body-tertiary w-100">Add to Cart</button>
                    </form>
                    @if ($userReview)
                        <form method="post" class="w-100" action="{{ route('review.delete', ['game_id' => $game->id, 'user_id' => auth()->user()->id]) }}">
                            @csrf
                            @method('DELETE') <!-- Use the DELETE method for deletion -->
                            <button type="submit" class="mb-3 fs-4 hover-effect rounded-3 border-0 w-25 m-auto py-2 bg-danger w-100">Remove Review</button>
                        </form>
                    @endif
                @endif
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('game.edit', $game->id) }}" class="mb-3 fs-4 hover-effect rounded-3 text-center border-0 w-25 m-auto py-2 bg-warning w-100">Edit</a>
                    <form method="post" action="{{ route('game.delete', $game->id) }}" class="w-100">
                        @csrf
                        @method('delete')
                        <button type="submit" class="mb-3 fs-4 hover-effect rounded-3 border-0 w-25 m-auto py-2 bg-danger w-100">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
    <div class="d-flex flex-column justify-content-between" style="width:75%">
        <div>
            <div>
                <h1>{{ $game->name }}</h1>
            </div>
            <div>
                <h2><a href="{{ route('developer.show', $game->dev_id) }}">{{ $game->developer->name }}</a></h2>
            </div>
            <div>
                <p>{{ $game->description }}</p>
            </div>
        </div>
        @auth
            @if (auth()->user()->role === 'customer')
                <div class="mb-3">
                    <h3>Add a comment</h3>
                    <div class="d-flex w-100" style="margin-top: -10px;">
                        <div class="w-100" style="margin-top: 2px;">
                            <form method="post" action="{{ route('review.store', ['game_id' => $game->id, 'user_id' => auth()->user()->id]) }}">
                                @csrf
                                <input type="hidden" name="rating" id="rating" value="0">
                                <!-- Star rating -->
                                <div class="d-flex align-items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" class="star-btn" data-rating="{{ $i }}" onclick="setRating({{ $i }})">
                                            <i class="bi bi-star"></i>
                                        </button>
                                        @if ($i < 5)
                                            <div class="me-2"></div> <!-- Adjust the margin as needed -->
                                        @endif
                                    @endfor
                                </div>
                            
                                <!-- Review textarea -->
                                <div class="form-group my-3 ">
                                    <textarea name="comment" id="txtComment" class="bg-blackish form-control border-0 border-white text-white gray-placeholder" placeholder="Add a comment..." rows="2"></textarea>
                                </div>
                            
                                <!-- Submit button for rating and review -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-light">Rate and Review</button>
                                </div>
                                @error('rating')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('comment')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>                    
                </div>
            @endif
            @if ($userReview)
                <div class="mt-4">
                    <h3>Your Review</h3>
                    <div class="px-3 py-3 d-flex flex-column justify-content-between my-3 bg-blackish rounded-3">
                        <div>
                            <h4>{{ $userReview->user->name }}</h4>
                            <div>
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $userReview->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p style="margin-bottom: 0;" class="fs-5 mt-4">{{ $userReview->comment }}</p>
                    </div>
                </div>
            @endif
        @endauth
        <div class="mt-4">
            @if($review->count() !== 0)
                <h3>User Reviews</h3>
                @foreach ($review as $r)
                    @if ($userReview)
                        @if ($r->user_id !== $userReview->user_id)
                            <div class="px-3 py-3 d-flex flex-column justify-content-between my-3 bg-blackish rounded-3">
                                <div>
                                    <h4>{{ $r->user->name }}</h4>
                                    <div>
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $r->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p style="margin-bottom: 0;" class="fs-5 mt-4">{{ $r->comment }}</p>
                            </div>
                        @endif
                    @else
                    <div class="px-3 py-3 d-flex flex-column justify-content-between my-3 bg-blackish rounded-3">
                        <div>
                            <h4>{{ $r->user->name }}</h4>
                            <div>
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $r->rating)
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p style="margin-bottom: 0;" class="fs-5 mt-4">{{ $r->comment }}</p>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const starButtons = document.querySelectorAll(".star-btn");
        starButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                const rating = button.getAttribute("data-rating");
                highlightStars(rating);
            });
        });

        function highlightStars(rating) {
            starButtons.forEach(function (button) {
                const buttonRating = button.getAttribute("data-rating");
                const starIcon = button.querySelector("i");
                if (buttonRating <= rating) {
                    starIcon.classList.remove("bi-star");
                    starIcon.classList.add("bi-star-fill");
                } else {
                    starIcon.classList.remove("bi-star-fill");
                    starIcon.classList.add("bi-star");
                }
            });
        }
        
        
    });

    function setRating(rating) {
        document.getElementById('rating').value = rating;
    }
    
    
    var txtComments = document.getElementById('txtComment');
    txtComments.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
    
</script>
@endsection