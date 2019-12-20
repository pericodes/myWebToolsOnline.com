	function clearInput() {
		let text = document.getElementById('text-input').value = "";
	}
	function copyToClipboard(element) {
		document.getElementById(element).select();
		document.execCommand("copy");
	}