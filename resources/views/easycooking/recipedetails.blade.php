@extends('easycooking.layout')
@section('content')

<div class="card-container">
    <div class="card mb-3">
        <img src="<?= $recipe->imageurl ?>" class="img-fluid card-img-top text-center bg-dark"
            alt="Recipe Image" style="max-height: 300px;">
        <hr />
        <div class="card-body">
            <!-- Content Title -->
            <h5 class="card-title">
                <?= $recipe->name ?>
            </h5>
            <hr />

            <!-- Font Size Adjustment Buttons -->
            <div class="text-center">
                <button onclick="adjustFontSize('increase')" class="btn btn-primary icon-btn">
                    <i class="bi bi-zoom-in"></i>
                </button>
                <button onclick="adjustFontSize('decrease')" class="btn btn-primary icon-btn">
                    <i class="bi bi-zoom-out"></i>
                </button>
                <button onclick="adjustFontSize('reset')" class="btn btn-primary">Default</button>
            </div>

            <!-- Content Section -->
            <p class="card-text">
            <div id="recipe-content" class="recipe-content">
                {!! $recipe->method !!}
            </div>
            </p>

            <iframe width="950" height="300" src="https://www.youtube.com/embed/p3yoKfvd7Fk"
                title="Burmese COLD &amp; SWEET FALOODA DRINK Recipe | အေးစိမ့်ချိုမွှေး ဖါလူဒါလုပ်နည်း" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>

            <p class="card-text"><small class="text-muted">Posted on
                    <?= $recipe->created_at ?>
                </small></p>
        </div>
    </div>
</div>



<!-- Custom Script for Font Size Adjustment -->
<script>
    function adjustFontSize(action) {
            const contentElement = document.getElementById('recipe-content');
            const currentFontSize = parseInt(window.getComputedStyle(contentElement).fontSize);

            const step = 2; // You can adjust the step size as needed

            if (action === 'increase') {
                contentElement.style.fontSize = `${currentFontSize + step}px`;
            } else if (action === 'decrease') {
                contentElement.style.fontSize = `${Math.max(currentFontSize - step, 12)}px`;
            } else if (action === 'reset') {
                contentElement.style.fontSize = '16px';
            }
        }

        // Add img-fluid class to all img tags inside the recipe-content
        $(document).ready(function() {
            $("#recipe-content img").addClass("img-fluid");
            $("#recipe-content img").addClass("text-center mx-auto d-block");
            $('iframe:not([id])').css('width', '100%');
        });

        // $(document).ready(function() {
        //     // $("#recipe-content img").css("width", "100%");
        //     var x = document.getElementById('iframe');
        //     x.style.width = "100%";
        //     x.style.height = "300";
        // });
</script>
@endsection