<table id="calendar" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="10%"></th>
			<th width="30%">Matin</th>
			<th width="30%">Midi</th>
			<th width="30%">Soir</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($days as $date => $agenda)
			<tr class="{{ ($date == date('d/m/Y')) ? 'active' : '' }}">
				<td>{{ $date }}</td>
				<td>
					@if (is_array($agenda) && isset($agenda['matin']))
						<a href="#" class="recette-link" data-id="{{ $agenda['matin']['id'] }}">
							{{ $agenda['matin']['nom'] }}
						</a>
					@endif
				</td>
				<td>
					@if (is_array($agenda) && isset($agenda['midi']))
						<a href="#" class="recette-link" data-id="{{ $agenda['midi']['id'] }}">
							{{ $agenda['midi']['nom'] }}
						</a>
					@endif
				</td>
				<td>
					@if (is_array($agenda) && isset($agenda['soir']))
						<a href="#" class="recette-link" data-id="{{ $agenda['soir']['id'] }}">
							{{ $agenda['soir']['nom'] }}
						</a>
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function() {
		$('.recette-link').click(function() {
			$.ajax({
				type: "GET",
				url: baseURL+"/agendas/recette/"+$(this).data('id'),
				async: true,
				data: {},
				success: function(data) {
					if (typeof(data) == 'object' && typeof(data.status) == 'boolean') {
						$('#myModal').html(data.html)
						$('#myModal').modal()
					} else {
						alert('Erreur retour: ');
					}
				}
			})

		});
	});
</script>
