@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		@include('statistic.video.top_menu')
	</div>
	<div class="row">
		<div class="col-xs-12">
		<div class="row">
				<div class="col-xs-12">
					<form class="form-inline" role="form" method="get">
						<div class="row">
							<div class="input-group col-xs-2 form-group">
								<span class="input-group-addon">С:</span>
								<input type="text" class="form-control" value="{{$from}}" name="from">
							</div>
							<div class="input-group col-xs-2 form-group">
								<span class="input-group-addon">По:</span>
								<input type="text" class="form-control" value="{{$to}}" name="to">
							</div>
							<div class="input-group col-xs-2 form-group">
								<select name="number" class="form-control">
									<option @if ($number==5) selected @endif value="5">5</option>
									<option @if ($number==10) selected @endif value="10">10</option>
									<option @if ($number==15) selected @endif value="15">15</option>
									<option @if ($number==20) selected @endif value="20">20</option>
									<option @if ($number==30) selected @endif value="30">30</option>
									<option @if ($number==50) selected @endif value="50">50</option>
									<option @if ($number==100) selected @endif value="100">100</option>
								</select>
							</div>
							<div class="col-xs-2 input-group form-group">
								<button type="submit" class="btn btn-primary">Применить</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<h4 class="text-center">Видео статистика по партнеру <b>{{$userProf->name}}</b> в период с {{date('d-m-Y',strtotime($from))}} по {{date('d-m-Y',strtotime($to))}}</h4>
				<div class="col-xs-12">
					{!! $partner_stats->appends(['from'=>$from, 'to'=>$to, 'number'=>$number, 'order'=>$order, 'direct'=>$direct])->render() !!}
					<div>
						<ul class="nav nav-tabs nav-justified cust-tabs">
							<li class="heading text-left active"><a href="#summary_stat" data-toggle="tab">Общая статистика</a></li>
							<li class="heading text-left"><a href="#rus_stat" data-toggle="tab">Статистика по России</a></li>
							<li class="heading text-left"><a href="#cis_stat" data-toggle="tab">Статистика по СНГ</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="summary_stat">
								<table class="table table-hover table-bordered" style="margin-top: 10px">
									<thead>
										<tr>
											@foreach($header as $k=>$row)
												<td>
													@if($row['index'])<a class="table_href" href="/{{$row['url']}}">{{$row['title']}}</a>@else {{$row['title']}} @endif
												</td>
											@endforeach
										</tr>
									</thead>
									<tr style="background: black; color: white">
										<td>Всего</td>
										<td>{{$partner_all_stat->loaded}}</td>
										<td>{{$partner_all_stat->played}}</td>
										<td>{{$partner_all_stat->calculate}}</td>
										<td>{{$partner_all_stat->deep}}</td>
										<td>{{$partner_all_stat->util}}</td>
										<td>{{$partner_all_stat->dosm}}</td>
										<td>{{$partner_all_stat->clicks}}</td>
										<td>{{$partner_all_stat->ctr}}</td>
										<td>{{$partner_all_stat->second}}</td>
										<td>{{$partner_all_stat->second_all}}</td>
										<td>{{$partner_all_stat->second_summa}}</td>
										<td>{{$partner_all_stat->summa}}</td>
									</tr>
									@foreach ($partner_stats as $partner_stat)
										<tr>
											<td>{{$partner_stat->day}}</td>
											<td>{{$partner_stat->loaded}}</td>
											<td>{{$partner_stat->played}}</td>
											<td>{{$partner_stat->calculate}}</td>
											<td>{{$partner_stat->deep}}</td>
											<td>{{$partner_stat->util}}</td>
											<td>{{$partner_stat->dosm}}</td>
											<td>{{$partner_stat->clicks}}</td>
											<td>{{$partner_stat->ctr}}</td>
											<td>{{$partner_stat->second}}</td>
											<td>{{$partner_stat->second_all}}</td>
											<td>{{$partner_stat->second_summa}}</td>
											<td>{{$partner_stat->summa}}</td>
										</tr>
									@endforeach
								</table>
							</div>
							
							<div class="tab-pane" id="rus_stat">
								<table class="table table-hover table-bordered" style="margin-top: 10px">
									<thead>
										<tr>
											@foreach($header as $k=>$row)
												<td>
													@if($row['index'])<a class="table_href" href="/{{$row['url']}}">{{$row['title']}}</a>@else {{$row['title']}} @endif
												</td>
											@endforeach
											<!--<td>Дата</td>
											<td>Загрузки</td>
											<td>Показы</td>
											<td>Зачтенные показы</td>
											<td>Глубина</td>
											<td>Утиль</td>
											<td>Досмотры</td>
											<td>Клики</td>
											<td>Ctr</td>
											<td>Доход</td>-->
										</tr>
									</thead>
									<tr style="background: black; color: white">
										<td>Всего</td>
										<td>{{$partner_ru_all_stats->loaded}}</td>
										<td>{{$partner_ru_all_stats->played}}</td>
										<td>{{$partner_ru_all_stats->calculate}}</td>
										<td>{{$partner_ru_all_stats->deep}}</td>
										<td>{{$partner_ru_all_stats->util}}</td>
										<td>{{$partner_ru_all_stats->dosm}}</td>
										<td>{{$partner_ru_all_stats->clicks}}</td>
										<td>{{$partner_ru_all_stats->ctr}}</td>
										<td>{{$partner_ru_all_stats->second}}</td>
										<td>{{$partner_ru_all_stats->second_all}}</td>
										<td>{{$partner_ru_all_stats->second_summa}}</td>
										<td>{{$partner_ru_all_stats->summa}}</td>
									</tr>
									@foreach ($partner_ru_stats as $partner_ru_stat)
										<tr>
											<td>{{$partner_ru_stat->day}}</td>
											<td>{{$partner_ru_stat->loaded}}</td>
											<td>{{$partner_ru_stat->played}}</td>
											<td>{{$partner_ru_stat->calculate}}</td>
											<td>{{$partner_ru_stat->deep}}</td>
											<td>{{$partner_ru_stat->util}}</td>
											<td>{{$partner_ru_stat->dosm}}</td>
											<td>{{$partner_ru_stat->clicks}}</td>
											<td>{{$partner_ru_stat->ctr}}</td>
											<td>{{$partner_ru_stat->second}}</td>
											<td>{{$partner_ru_stat->second_all}}</td>
											<td>{{$partner_ru_stat->second_summa}}</td>
											<td>{{$partner_ru_stat->summa}}</td>
										</tr>
									@endforeach
								</table>
							</div>
							
							<div class="tab-pane" id="cis_stat">
								<table class="table table-hover table-bordered" style="margin-top: 10px">
									<thead>
										<tr>
											@foreach($header as $k=>$row)
												<td>
													@if($row['index'])<a class="table_href" href="/{{$row['url']}}">{{$row['title']}}</a>@else {{$row['title']}} @endif
												</td>
											@endforeach
											<!--<td>Дата</td>
											<td>Загрузки</td>
											<td>Показы</td>
											<td>Зачтенные показы</td>
											<td>Глубина</td>
											<td>Утиль</td>
											<td>Досмотры</td>
											<td>Клики</td>
											<td>Ctr</td>
											<td>Доход</td>-->
										</tr>
									</thead>
									<tr style="background: black; color: white">
										<td>Всего</td>
										<td>{{$partner_cis_all_stats->loaded}}</td>
										<td>{{$partner_cis_all_stats->played}}</td>
										<td>{{$partner_cis_all_stats->calculate}}</td>
										<td>{{$partner_cis_all_stats->deep}}</td>
										<td>{{$partner_cis_all_stats->util}}</td>
										<td>{{$partner_cis_all_stats->dosm}}</td>
										<td>{{$partner_cis_all_stats->clicks}}</td>
										<td>{{$partner_cis_all_stats->ctr}}</td>
										<td>{{$partner_cis_all_stats->second}}</td>
										<td>{{$partner_cis_all_stats->second_all}}</td>
										<td>{{$partner_cis_all_stats->second_summa}}</td>
										<td>{{$partner_cis_all_stats->summa}}</td>
									</tr>
									@foreach ($partner_cis_stats as $partner_cis_stat)
										<tr>
											<td>{{$partner_cis_stat->day}}</td>
											<td>{{$partner_cis_stat->loaded}}</td>
											<td>{{$partner_cis_stat->played}}</td>
											<td>{{$partner_cis_stat->calculate}}</td>
											<td>{{$partner_cis_stat->deep}}</td>
											<td>{{$partner_cis_stat->util}}</td>
											<td>{{$partner_cis_stat->dosm}}</td>
											<td>{{$partner_cis_stat->clicks}}</td>
											<td>{{$partner_cis_stat->ctr}}</td>
											<td>{{$partner_cis_stat->second}}</td>
											<td>{{$partner_cis_stat->second_all}}</td>
											<td>{{$partner_cis_stat->second_summa}}</td>
											<td>{{$partner_cis_stat->summa}}</td>
										</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
					{!! $partner_stats->appends(['from'=>$from, 'to'=>$to, 'number'=>$number, 'order'=>$order, 'direct'=>$direct])->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('cabinet_home')
	<link href="{{ asset('css/daterange/daterangepicker.css') }}" rel="stylesheet">
	<style>
		.table{
			text-align: center;
		}
		.table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td{
			vertical-align: middle;
			border: 1px solid #ababab;
		}
		.body_sum{
			font-weight: bolder;
		}
		.celi_pok{
			display: inline-block!important;
			width: 10px;
			height: 10px;
		}
		.rur{
		font-style: normal;
		}
		.right_pok{
		display: inline-block;
		width: 200px;
		}
		.table_href{
		color: inherit;
		}
		.cust-tabs .active a{
			font-weight: 600;
			color: #3b4371!important;
		}
		.cust-tabs li a{
			color: #3b4371;
			letter-spacing: 1.1px;
		}
	</style>
@endpush
@push('cabinet_home_js')
	<script src="{{ asset('js/daterange/moment.js') }}"></script>
	<script src="{{ asset('js/daterange/daterangepicker.js') }}"></script>
	<script>
		$(function(){
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	<script>	
$(function() {
    $('input[name="from"]').daterangepicker({
	singleDatePicker: true,
        showDropdowns: true,
		"locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Применить",
        "cancelLabel": "Отмена",
        "fromLabel": "От",
        "toLabel": "До",
        "customRangeLabel": "Свой",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1
    }
	});
	$('input[name="to"]').daterangepicker({
	singleDatePicker: true,
        showDropdowns: true,
		"locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Применить",
        "cancelLabel": "Отмена",
        "fromLabel": "От",
        "toLabel": "До",
        "customRangeLabel": "Свой",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1
    }
	});
});	
</script>
@endpush