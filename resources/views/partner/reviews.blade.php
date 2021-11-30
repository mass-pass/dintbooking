@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
<section>
    <div class="content-wrapper">
        <div class="container">
            <div class="page-header">
                <div class="page-info">
                    <h4 class="mb-0">Guest Review</h4>
                </div>
            </div>
            <!-- spacer -->
            <div class="hr">
                <hr>
            </div>
            <!-- spacer -->
            <div class="content-body">
                <div class="guest-review-wrapper">
                    <div class="row">
                        <div class="col-md-12 col-lg-10 col-xl-8">
                            <p>Your property hasn't been reviewd yet. Keep an eye out for upcoming guest reviews on this page. <br> <a href="#">Click here</a> to see our review/reply policy.</p>
                            <div class="text-center">
                                <p> <i class="fa fa-file-alt fa-3x"></i></p>
                                <p>Your property hasn't been reviewed yet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop