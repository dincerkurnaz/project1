<html>
	<head>
		<title>{{.Name}}</title>
	</head>
	<body>
		{{if .CanGoUp}}<a href="..">Up one level</a><br>{{end}}
                <a href="/">Home Page :)</a>
		<h1>{{.Path}}</h1>
		{{range .Items}}
		<a href="{{.URL}}">{{.Name}}</a><br>
		{{end}}
	</body>
</html>
