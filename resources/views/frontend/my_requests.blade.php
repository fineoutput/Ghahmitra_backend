@extends('frontend.common.app')
@section('title','My Requests')
@section('content')
<style>
.rating-stars {
  font-size: 28px;
  cursor: pointer;
}

.star {
  color: #ccc;
  transition: 0.2s;
}

.star.selected,
.star.hovered {
  color: #ffc107;
}
</style>
<section class="py-5">
  <div class="container">
   

    
<div class="my-orders-section">

    <h2 class="orders-title">My Orders</h2>

    @foreach ($orders as $value)
    <div class="order-card">

        <div class="order-top">
            <div class="order-left">

                <h5 class="service-name">#{{$value->id}}</h5>
                
                <div class="order-date">
                    📅 {{ $value->created_at->format('d M Y') }}
                </div>
                
                {{-- <div class="status-pill">
                    <span class="icon">🧰</span>
                    Not Yet Connected
                </div> --}}
                {{-- <span class="badge-closed">CLOSED</span> --}}


            </div>
{{-- <div class="order-image">
    <img src="{{ asset($value->orderItems->first()->service->image[0] ?? '') }}" alt="">
</div> --}}
        </div>

        <div class="order-bottom">
          {{-- <a href="{{ route('request_detail') }}">
            <button class="view-btn">
                View Details →
            </button>
            </a> --}}

            <div class="d-flex justify-content-between gap-2">
                <a href="{{ route('orderdetail', $value->id) }}">
    <button class="view-btn">
        View Details →
    </button>
</a>

   <button 
        class="view-btn"
        onclick="openReviewModal({{ $value->id }})"
    >
        Add Review
    </button>
            </div>
        </div>

    </div>

    <div class="modal fade" id="reviewModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">

      <div class="modal-header border-0">
        <h5 class="modal-title">Rate your service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <p class="text-muted small mb-3">
          How was your experience with the professional?
        </p>

        <div class="rating-stars text-center mb-3" id="ratingStars">
          <span class="star" data-value="1">★</span>
          <span class="star" data-value="2">★</span>
          <span class="star" data-value="3">★</span>
          <span class="star" data-value="4">★</span>
          <span class="star" data-value="5">★</span>
        </div>

        <textarea 
          class="form-control mb-3" 
          id="reviewComment" 
          placeholder="Share your feedback (optional)">
        </textarea>

        <input type="hidden" id="orderId">

        <button class="btn btn-primary w-100 rounded-3" onclick="submitReview()">
          Submit Review
        </button>

      </div>

    </div>
  </div>
</div>
    @endforeach

</div>
  </div>

</section>
<script>
let selectedRating = 0;

function openReviewModal(orderId){
    document.getElementById('orderId').value = orderId;

    selectedRating = 0;
    document.getElementById('reviewComment').value = '';

    const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
    modal.show();

    setTimeout(initRatingStars, 200); // ensure DOM ready
}

function initRatingStars(){
    const starsContainer = document.getElementById('ratingStars');
    if (!starsContainer) return;

    const stars = starsContainer.querySelectorAll('.star');

    stars.forEach(star => {
        const value = parseInt(star.getAttribute('data-value'));

        star.onclick = function(){
            selectedRating = value;
            updateStarStyles(stars);
        };

        star.onmouseenter = function(){
            updateStarStyles(stars, value);
        };

        star.onmouseleave = function(){
            updateStarStyles(stars);
        };
    });
}

function updateStarStyles(stars, hoverValue = 0){
    stars.forEach(star => {
        const val = parseInt(star.getAttribute('data-value'));

        star.classList.toggle('selected', val <= selectedRating);
        star.classList.toggle('hovered', hoverValue && val <= hoverValue);

        if (!hoverValue){
            star.classList.remove('hovered');
        }
    });
}

function submitReview(){
    if (!selectedRating){
        alert('Please select a star rating.');
        return;
    }

    const orderId = document.getElementById('orderId').value;
    const comment = document.getElementById('reviewComment').value.trim();

    console.log({
        order_id: orderId,
        rating: selectedRating,
        comment: comment
    });

    alert('Review submitted successfully!');

    const modal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
    modal.hide();
}
</script>
@endsection