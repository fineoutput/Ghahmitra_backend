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

<div class="row g-3">
@foreach ($orders as $value)
    <div class="col-md-4">
        <div class="order-card card h-100">

            <div class="order-top d-flex justify-content-between align-items-center p-2">
                <div class="order-left">
                    <h5 class="service-name">#{{ $value->id }}</h5>
                    <div class="order-date text-muted">
                        📅 {{ $value->created_at->format('d M Y') }}
                    </div>
                </div>
                <div class="order-image">
                    <img src="{{ asset($value->orderItems->first()->service->image[0] ?? '') }}" 
                         class="img-fluid rounded" 
                         style="width: 60px; height: 60px; object-fit: cover;" 
                         alt="">
                </div>
            </div>

            <div class="order-bottom p-2">
                <div class="d-flex justify-content-between gap-2">
                    <a href="{{ route('orderdetail', $value->id) }}" class="btn btn-outline-primary btn-sm flex-fill">
                        View Details →
                    </a>

                    @if($value->order_status == 3)
                    <button 
                        class="btn btn-primary btn-sm flex-fill"
                        onclick="openReviewModal({{ $value->orderItems->first()->service_id }}, {{ $value->id }})"
                    >
                        Add Review
                    </button>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endforeach
</div>

<!-- Single Modal for All Orders -->
{{-- <div class="modal fade" id="reviewModal" tabindex="-1">
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

        <!-- Form -->
        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf

            <!-- Stars -->
            <div class="rating-stars text-center mb-3" id="ratingStars">
              <span class="star" data-value="1">★</span>
              <span class="star" data-value="2">★</span>
              <span class="star" data-value="3">★</span>
              <span class="star" data-value="4">★</span>
              <span class="star" data-value="5">★</span>
            </div>

            <input type="hidden" name="star" id="starInput" value="0">
            <input type="hidden" name="service_id" id="serviceId">
            <input type="hidden" name="order_id" id="orderId">

            <!-- Feedback -->
            <textarea 
              class="form-control mb-3" 
              name="description"
              id="reviewComment" 
              placeholder="Share your feedback (optional)">
            </textarea>

            <button type="submit" class="btn btn-primary w-100 rounded-3">
              Submit Review
            </button>
        </form>

      </div>

    </div>
  </div>
</div> --}}

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

        <!-- Form -->
        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf

            <!-- Stars -->
            <div class="rating-stars text-center mb-3" id="ratingStars">
              <span class="star" data-value="1">★</span>
              <span class="star" data-value="2">★</span>
              <span class="star" data-value="3">★</span>
              <span class="star" data-value="4">★</span>
              <span class="star" data-value="5">★</span>
            </div>

            <input type="hidden" name="star" id="starInput" value="0">

            <!-- Feedback -->
            <textarea 
              class="form-control mb-3" 
              name="description"
              id="reviewComment" 
              placeholder="Share your feedback (optional)">
            </textarea>

            <!-- Hidden Fields -->
            <input type="hidden" name="user_id" id="userId">
            <input type="hidden" name="service_id" id="serviceId">
            <input type="hidden" name="order_id" id="orderId">

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100 rounded-3">
              Submit Review
            </button>
        </form>

      </div>

    </div>
  </div>
</div>

</div>
  </div>

</section>
<script>


let selectedStar = 0;

function openReviewModal(serviceId, orderId) {
    // Set hidden inputs
    document.getElementById('userId').value = userId;
    document.getElementById('serviceId').value = serviceId;
    document.getElementById('orderId').value = orderId;

    // Reset star and comment
    selectedStar = 0;
    document.getElementById('starInput').value = 0;
    document.getElementById('reviewComment').value = '';

    updateStars(0);

    // Show modal
    new bootstrap.Modal(document.getElementById('reviewModal')).show();
}

// Star click handler
document.querySelectorAll('#ratingStars .star').forEach(star => {
    star.addEventListener('click', function() {
        selectedStar = parseInt(this.dataset.value);
        document.getElementById('starInput').value = selectedStar;
        updateStars(selectedStar);
    });
});

function updateStars(count) {
    document.querySelectorAll('#ratingStars .star').forEach(star => {
        star.style.color = (parseInt(star.dataset.value) <= count) ? '#FFD700' : '#ccc';
    });
}


// let selectedRating = 0;

// function openReviewModal(orderId){
//     document.getElementById('orderId').value = orderId;

//     selectedRating = 0;
//     document.getElementById('reviewComment').value = '';

//     const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
//     modal.show();

//     setTimeout(initRatingStars, 200); // ensure DOM ready
// }

// function initRatingStars(){
//     const starsContainer = document.getElementById('ratingStars');
//     if (!starsContainer) return;

//     const stars = starsContainer.querySelectorAll('.star');

//     stars.forEach(star => {
//         const value = parseInt(star.getAttribute('data-value'));

//         star.onclick = function(){
//             selectedRating = value;
//             updateStarStyles(stars);
//         };

//         star.onmouseenter = function(){
//             updateStarStyles(stars, value);
//         };

//         star.onmouseleave = function(){
//             updateStarStyles(stars);
//         };
//     });
// }

// function updateStarStyles(stars, hoverValue = 0){
//     stars.forEach(star => {
//         const val = parseInt(star.getAttribute('data-value'));

//         star.classList.toggle('selected', val <= selectedRating);
//         star.classList.toggle('hovered', hoverValue && val <= hoverValue);

//         if (!hoverValue){
//             star.classList.remove('hovered');
//         }
//     });
// }

// function submitReview(){
//     if (!selectedRating){
//         alert('Please select a star rating.');
//         return;
//     }

//     const orderId = document.getElementById('orderId').value;
//     const comment = document.getElementById('reviewComment').value.trim();

//     console.log({
//         order_id: orderId,
//         rating: selectedRating,
//         comment: comment
//     });

//     alert('Review submitted successfully!');

//     const modal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
//     modal.hide();
// }
</script>
@endsection