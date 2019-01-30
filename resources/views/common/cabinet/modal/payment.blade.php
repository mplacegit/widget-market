<div id="payment" data-set="{{$user->profile->vip}}" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="affiliate_modal_header">Заказ выплаты<button class="modal_exit glyphicon glyphicon-remove-sign" type="button" data-dismiss="modal" data-toggle="tooltip" data-placement="bottom" title="Закрыть"></button></div>
			<hr class="modal_hr">
			<!--{{ $all_options = count(\DB::table('users_payment_options')->where('user_id', $user->id)->whereNotNull('value')->get())}}-->
			@if ($all_options>0)
			<form class="form-horizontal" role="form" method="post" action="{{ route('user_payout')}}">
				{!! csrf_field() !!}
				<input type="hidden" name="user_id" value="{{$user->id}}">
				<div class="form-group">
					<label for="summa" class="col-xs-4 control-label">Сумма</label>
					<div class="col-xs-6">
						<input name="summa" id="summa_for_pay" type="number" min="300" max="{{$user->profile->balance}}" step="0.01" value="{{floor($user->profile->balance)}}" class="form-control" required>
						<span class="help-block" style="margin: 0;" id="text_for_user_pay">
								<strong>Минимальная сумма выплаты 300 руб.</strong>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="summa" class="col-xs-4 control-label">Платежная система</label>
					<div class="col-xs-6">
						<!-- {{$pay_option=\DB::table('payment_options')->orderBy('id', 'asc')->get()}} -->
						<select name="pay_option" class="form-control">
							@foreach ($pay_option as $option)
								@if ($option->id!=2)
									@if (\DB::table('users_payment_options')->where('user_id', $user->id)->where('payment_id', $option->id)->first())
										@if (\DB::table('users_payment_options')->where('user_id', $user->id)->where('payment_id', $option->id)->first()->value)
											<option @if ($user->profile->payment_option_id==$option->id) selected @endif value="{{$option->id}}">{{$option->name}} @if ($option->id==6) Комиссия 1% @endif</option>
										@endif
									@endif
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="summa" class="col-xs-4 control-label">Срочный вывод</label>
					<div class="col-xs-6">
						<input name="urgently" value="1" type="checkbox" id="user_urgently_pay" style="margin-top: 12px;">
						@if (!$user->profile->vip and !$user->hasRole('admin') and !$user->hasRole('manager') and !$user->hasRole('super_manager'))
						<span class="help-block" style="margin: 0; color: rgb(181, 0, 0);">
								<strong>Комиссия 6%</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-1 col-xs-10 text-center">
					  <a id="payment_submit" class="btn btn-primary">Запросить</a>
					</div>
				</div>
			</form>
			@else
				<div class="row">
					<div class="col-xs-offset-1 col-xs-10">
						@if (\Auth::user()->hasRole('admin') or \Auth::user()->hasRole('manager') or \Auth::user()->hasRole('super_manager'))
							<p>Пожалуйста, заполните платежные реквизиты в <a href="{{route('admin.profile.personal', ['id_user'=>$user->profile->user_id])}}">редакторе профиля</a></p>
						@else
							<p>Пожалуйста, заполните платежные реквизиты в <a href="{{route('profile.personal')}}">редакторе профиля</a></p>
						@endif
					</div>
				</div>
			@endif
		</div>
	</div>
</div>