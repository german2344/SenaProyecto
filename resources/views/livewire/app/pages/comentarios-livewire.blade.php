<div>
    <link rel="stylesheet" href="{{ asset('css/shared/opinion.css')}}"> 
    <section class="review" id="review">
        <h1 class="heading"> su <span>opinion</span> </h1>
        <div class="my-4">
            @can('admin.comments.store')
                <div class="flex m-6 mx-auto w-full">
                @livewire('shared.form-comment') 
                </div>
            @endcan
        </div>
            <div class="box-container">
                @foreach ($comentarios as $comment )
                    <livewire:app.components.card.card-comment :comment="$comment" :key="$comment->id" lazy/>
                @endforeach
            </div>
    </section> 
</div>
