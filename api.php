<h1>API та бекенд</h1>
<div class="card-panel orange">
	<button class="btn indigo" onclick="postClick()">POST</button>
	<div id="api-result"></div>
</div>

<script>

function postClick() {
	fetch("/tables", {
		method: 'POST'
	})
	.then(r => r.text())
	.then(t => {
		document.getElementById("api-result").innerText = t;
	});
}
</script>
