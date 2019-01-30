@include('charts::_partials.container.div')
@push('donut')
<script>
var {{ $model->id }} = c3.generate({
    bindto: '#{{ $model->id }}',
    data: {
        columns: [
            @for($i = 0; $i < count($model->labels); $i++)
                ["{!! $model->labels[$i] !!}", {{ $model->values[$i] }}],
            @endfor
        ],
        type: 'donut',
    },
	@if($model->legend==false)
	legend: {
	  show: false
	},
	@endif
tooltip: {
  format: {
    value: function (value, ratio, id, index) { return value; }
  }
},
    axis: {
        x: {
            type: 'category',
            categories: [@foreach($model->labels as $label)"{!! $label !!}",@endforeach]
        },
        y: {
            label: {
                text: "{!! $model->element_label !!}",
                position: 'outer-middle',
            }
        },
    },
    @if($model->title)
    title: {
        text:  "{!! $model->title !!}",
        x: -20 //center
    },
    @endif
});
</script>
@endpush