<div class="py-30 px-30 bg-white rounded-4 base-tr mt-30 {{$wrap_class ?? ''}}" data-x="flight-item-{{$row['onward']['sI'][0]['id']}}" data-x-toggle="shadow-{{$row['onward']['sI'][0]['id']}}">
    <div class="row y-gap-30 justify-between">
        <div class="col">
            <div class="row y-gap-10 items-center">
                <div class="col-sm-auto">
                    <div class="has-skeleton">
                        @php
                            $logo =\Modules\Flight\Services\FlightService::getAirLineLogo($row['onward']['sI'][0]['fD']['aI']['code'], true);
                        @endphp
                        <img class="size-40" src="{{ asset('uploads/'.$logo) }}" alt="{{$row['onward']['sI'][0]['fD']['aI']['name']}}">
                    </div>
                </div>
                <div class="col">
                    <div class="row x-gap-20 items-end">
                        <div class="col-auto">
                            <div class="has-skeleton">
                                <h6>Depart:</h6>
                                <div class="lh-15 fw-500">{{ \Carbon\Carbon::parse($row['onward']['sI'][0]['dt'])->format('D M d H:i') }}</div>
                                <div class="text-15 lh-15 text-light-1">{{$row['onward']['sI'][0]['da']['name']}}</div>
                            </div>
                        </div>

                        <div class="col text-center">
                            <div class="flightLine">
                                <div></div>
                                <div></div>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="has-skeleton">
                                <div class="lh-15 fw-500">{{ \Carbon\Carbon::parse($row['onward']['sI'][0]['at'])->format('D M d H:i') }}</div>
                                <div class="text-15 lh-15 text-light-1">{{$row['onward']['sI'][0]['aa']['name']}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-auto">
                    <div class="text-15 text-light-1 px-20 md:px-0 has-skeleton">{{(number_format($row['onward']['sI'][0]['duration']/60,2)).'h'}}</div>
                </div>
            </div>
            <div class="row y-gap-10 items-center">
                <div class="col-sm-auto">
                    <div class="has-skeleton">
                        @if ($row['return']['sI'][0]['fD']['aI']['code'] != $row['onward']['sI'][0]['fD']['aI']['code'])
                            @php
                                $logo =\Modules\Flight\Services\FlightService::getAirLineLogo($row['return']['sI'][0]['fD']['aI']['code'], true);
                            @endphp
                            <img class="size-40" src="{{ asset('uploads/'.$logo) }}" alt="{{$row['return']['sI'][0]['fD']['aI']['name']}}">
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="row x-gap-20 items-end">
                        <div class="col-auto">
                            <div class="has-skeleton">
                                <h6>Return:</h6>
                                <div class="lh-15 fw-500">{{ \Carbon\Carbon::parse($row['return']['sI'][0]['dt'])->format('D M d H:i') }}</div>
                                <div class="text-15 lh-15 text-light-1">{{$row['return']['sI'][0]['da']['name']}}</div>
                            </div>
                        </div>

                        <div class="col text-center">
                            <div class="flightLine">
                                <div></div>
                                <div></div>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="has-skeleton">
                                <div class="lh-15 fw-500">{{ \Carbon\Carbon::parse($row['return']['sI'][0]['at'])->format('D M d H:i') }}</div>
                                <div class="text-15 lh-15 text-light-1">{{$row['return']['sI'][0]['aa']['name']}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-auto">
                    <div class="text-15 text-light-1 px-20 md:px-0 has-skeleton">{{(number_format($row['return']['sI'][0]['duration']/60,2)).'h'}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="has-skeleton">
                <div class="d-flex items-center h-full">
                    <div class="pl-30 border-left-light h-full md:d-none"></div>

                    <div>
                        @php
                     
                            $onwardPublishedPrices = collect($row['onward']['totalPriceList'])->filter(function($price) {
                                                        return $price['fareIdentifier'] === 'PUBLISHED';
                                                    })->values()->all();
                            $onwardPublishedPrice     = $onwardPublishedPrices[0]['fd']['ADULT']['fC']['TF'] ?? $row['onward']['totalPriceList'][0]['fd']['ADULT']['fC']['TF'];
                            $onwardPublishedPriceId   = $onwardPublishedPrices[0]['id']?? $row['onward']['totalPriceList'][0]['id'];

                            $returnPublishedPrices = collect($row['return']['totalPriceList'] ?? [])->filter(function($price) {
                                                        return $price['fareIdentifier'] === 'PUBLISHED';
                                                    })->values()->all() ?? 0;
                            $returnPublishedPrice     = $returnPublishedPrices[0]['fd']['ADULT']['fC']['TF'] ?? $row['return']['totalPriceList'][0]['fd']['ADULT']['fC']['TF'] ?? 0; 
                            $returnPublishedPriceId   = $returnPublishedPrices[0]['id'] ?? $row['return']['totalPriceList'][0]['id'] ?? '';
                            $total =$onwardPublishedPrice + $returnPublishedPrice;
                            $priceIds =json_encode([$onwardPublishedPriceId,$returnPublishedPriceId]);
                            // Initialize an array with $onwardPublishedPriceId
                            $priceIds = [$onwardPublishedPriceId];

                            // Check if $returnPublishedPriceId is set and not empty, then add it to the array
                            if (!empty($returnPublishedPriceId)) {
                                $priceIds[] = $returnPublishedPriceId;
                            }
                            // Encode the array into JSON format
                            $priceIds = json_encode($priceIds);
                        @endphp    
                        <div class="text-right md:text-left mb-10">
                            <div class="text-18 lh-16 fw-500">{{format_money(@$total)}}</div>
                            <div class="text-15 lh-16 text-light-1">{{__('avg/person')}}</div>
                        </div>
                        <div class="accordion__button">
                            {{-- @if($row->can_book) --}}
                                <a data-id="{{ $priceIds }}" href=""  onclick="event.preventDefault()" class="button -dark-1 px-30 h-50 bg-blue-1 text-white btn-choose-flight">{{__("Choose")}} <div class="icon-arrow-top-right ml-15"></div></a>
                            {{-- @else
                                <a  href="#"  class="button -dark-1 px-30 h-50 bg-warning-2 text-white btn-disabled">{{__("Full Book")}}</a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
