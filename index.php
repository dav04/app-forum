<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, user-scalable=yes">
		
		<title>Forum</title>
		
		<script src="components/bower_components/webcomponentsjs/webcomponents-lite.js"></script>
		<link rel="import" href="components/components.html">
        
        <script>
            // forumEdit è un evento per ottenere la modifica effettuata
            document.addEventListener('forumEdit', function() {
                alert("Il forum è stato modificato");
            });
        </script>
	</head>
	<body>
		<template is="dom-bind">
            <app-forum></app-forum>
		</template>
	</body>
</html>