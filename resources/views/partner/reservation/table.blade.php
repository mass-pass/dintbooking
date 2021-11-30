       <table class="table">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Guest Name</th>
                                    <th scope="col">Check-in</th>
                                    <th scope="col">Check-out</th>
                                    <th scope="col">Rooms</th>
                                    <th scope="col">Booked on</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Commission</th>
                                    <th scope="col">Booking number</th>
                                  </tr>
                                </thead>
                                <tbody >
                                	@php
                                	$property_fees = DB::table("property_fees")->where("field","partner_service_charge")->first()->value;
                                	@endphp
                                	@if(count($bookings)==0)
                                	<tr>
                                		<td colspan="9">
                                			<center>No Available Data</center>
                                		</td>
                                	</tr>
                                	@else
                                	@foreach($bookings as $b)
                                 <tr>
            <th scope="row">{{$b->first_name}} <br> {{$b->guest}} adults</th>
            <td>{{date("F d, Y",strtotime($b->start_date))}}</td>
            <td>{{date("F d, Y",strtotime($b->end_date))}}</td>
            <td>{{$b->name}}</td>
            <td>{{date("F d, Y",strtotime($b->created_at))}}</td>
            <td class="text-danger">{{$b->status}}</td>
            <td>US ${{$b->total_night * $b->per_night}}</td>
            <td>US ${{number_format(($b->total_night * $b->per_night)*$property_fees/100,2)}}</td>
            <td><a href="#">{{$b->host_id.$b->user_id.$b->id}}</a></td>
          </tr> 
          @endforeach
          @endif
                                  
                                </tbody>
                              </table>  