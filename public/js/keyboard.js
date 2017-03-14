$(document).ready(function() {

	var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure",
		"COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript",
		"Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme" ];

	$('.text-keyboard')
		.keyboard({ layout: 'qwerty' })
		.addTyping();

	$('.autocomplete-keyboard')
		.keyboard({ layout: 'qwerty' })
		// .autocomplete({
		// 	source: availableTags
		// })
		// position options added after v1.23.4
		// .addAutocomplete({
		// 	position : {
		// 		of : null,        // when null, element will default to kb.$keyboard
		// 		my : 'right top', // 'center top', (position under keyboard)
		// 		at : 'left top',  // 'center bottom',
		// 		collision: 'flip'
		// 	}
		// })
		.addTyping()
		.change();

	$('.number-keyboard')
		.keyboard({
			layout : 'num',
			restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
			preventPaste : true,  // prevent ctrl-v and right click
			autoAccept : true
		})
		.addTyping();

	$('.textarea')
		.keyboard({ layout: 'qwerty' })
		.autocomplete({
			source: availableTags
		})
		.addAutocomplete({
			position : {
				of : null,        // when null, element will default to kb.$keyboard
				my : 'right top', // 'center top', (position under keyboard)
				at : 'left top',  // 'center bottom',
				collision: 'flip'
			}
		})
		.addTyping();

});
