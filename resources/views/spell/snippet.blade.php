<div class='ui list'>
	<div class='item'>
		<div class='header'>
			Level/School
		</div>		
		{{ $spell->level }} {{ $spell->school }}
	</div>
	<div class='item'>
		<div class='header'>
			Cast Time
		</div>		
		{{ $spell->casting_time }}
	</div>
	<div class='item'>
		<div class='header'>
			Range
		</div>		
		{{ $spell->range }}
	</div>
	<div class='item'>
		<div class='header'>
			Component
		</div>
		{{ $spell->components }}		
	</div>
	<div class='item'>
		<div class='header'>
			Duration
		</div>
		{{ $spell->duration }}		
	</div>
	<div class='item'>
		<div class='header'>
			Materials
		</div>
		{{ $spell->material }}		
	</div>
	<div class='item'>
		<div class='header'>
			Concentration/Ritual
		</div>
		{{ ($spell->concentration == 1) ? 'yes' : 'no' }}	/ {{ ($spell->ritual == 1) ? 'yes' : 'no' }}	
	</div>
	<div class='item'>
		{!! clean($spell->description) !!}		
	</div>
</div>


