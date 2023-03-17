<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card rounded">
                <div class="card-body py-3 px-3">
                    {!! $expenseChart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chartscript --}}
@if($expenseChart)
{!! $expenseChart->script() !!}
@endif