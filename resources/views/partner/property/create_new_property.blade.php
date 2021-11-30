@extends('layouts.partner_template')

@section('main')
    <section style="padding-left: 20%;padding-top:3%;">
        <div class="content-wrapper" style="margin-top:0px;padding-top:0px;">
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Property Layout</h4>
                    </div>
                </div>
                <!-- spacer -->
                <div class="hr">
                    <hr>
                </div>
                <!-- spacer -->
                <div class="content-body" >
                    <form method="post" accept-charset='UTF-8'>
                    @csrf

                        @include('property_layouts.form')
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- content ends -->
    <!-- Modal starts -->
    <div id="onLoad-modal" class="modal fade" style="padding-left: 20%;padding-top:3%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Property</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Add to contract under the name of the Legal Entity</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select legal entity</option>
                                <option value="">Select legal entity</option>
                                <option value="">Select legal entity</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Country/Region</label>
                            <select name="" id="" class="form-control">
                                <option value="">Please select</option>
                                <option value="">Please select</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Build your property</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop