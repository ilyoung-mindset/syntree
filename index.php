<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta name="description" content="An app for producing linguistics syntax trees from labelled bracket notation." />
	<link rel="canonical" href="http://mshang.ca/syntree" />
	<title>Syntax Tree Generator</title>

	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-25344866-1']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
</head>


<body>
	<a href="https://github.com/mshang/syntree"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png" alt="Fork me on GitHub"></a>
	<div id="accordion">
		<h3><a href="#">Syntax Tree Generator</a></h3><div style="text-align:left">
			<textarea id="i" rows="4">(S  (NP_SBJ (NP_MOD 가계부/NNG + 의/JKG) (NP_SBJ 틀/NNG + 이/JKS)) (VP (VP 달라지/VV + 고/EC) (VP 있/VX + 다/EF + ./SF)))</textarea>
			(C) 2011 by <a href="http://mshang.ca/">Miles Shang</a>, see <a href="LICENSE.txt">license</a>.
		</div>
		
		<h3><a href="#">Options</a></h3><div>
			<table>
				<col width="1*">
				<col width="1*">
				<tr>
					<td colspan="2" align="center"><div id="font-style-radio" class="nobr">
						<input type="radio" name="font-style" id="serif" value="serif" class="redraw" /><label for="serif">Serif</label>
						<input type="radio" name="font-style" id="sans-serif" value="sans-serif" class="redraw" checked /><label for="sans-serif">Sans-Serif</label>
						<input type="radio" name="font-style" id="monospace" value="monospace" class="redraw" /><label for="monospace">Monospace</label>
					</div></td>
				</tr>
				<tr>
					<td align="center">Terminals:</td>
					<td align="center">Non-terminals:</td>
				</tr>
				<tr>
					<td align="center"><div id="term-font-check" class="nobr">
						<input type="checkbox" id="term-bold" class="redraw" /><label for="term-bold">Bold</label>
						<input type="checkbox" id="term-ital" class="redraw" /><label for="term-ital">Italic</label>
					</span></td>
					<td align="center"><div id="nonterm-font-check" class="nobr">
						<input type="checkbox" id="nonterm-bold" class="redraw" /><label for="nonterm-bold">Bold</label>
						<input type="checkbox" id="nonterm-ital" class="redraw" /><label for="nonterm-ital">Italic</label>
					</span></td>
				</tr>
				<tr>
					<td align="left">Font size:</td>
					<td><div id="font-size-slider"></div></td>
				</tr>
				<tr>
					<td align="left">Height:</td>
					<td><div id="vert-space-slider"></div></td>
				</tr>
				<tr>
					<td align="left">Width:</td>
					<td><div id="hor-space-slider"></div></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><div class="nobr">
						<input type="checkbox" id="color-check" class="redraw" checked /><label for="color-check">Color</label>
						<input type="checkbox" id="term-lines" class="redraw" checked /><label for="term-lines">Terminal lines</label>
						<a href="#" id="make-link">Link</a>
					</div></td>
				</tr>
			</table>
		</div>
	
		<h3><a href="#">Help</a></h3><div class="help">
			<p>Use labelled bracket notation. This app will build the tree as you type and will attempt to close any brackets that you may be missing. Save the image to your computer by right-clicking on it and selecting "Save image as". For more information, including on how to draw movement lines, visit the <a href="https://github.com/mshang/syntree/wiki">wiki</a>.</p>
			<h3>Examples</h3>
			<a class="example" href="?i=(NP^ Alice)">(NP^ Alice)</a><br />
			<a class="example" href="?i=(NP (N Alice) and (N Bob))">(NP (N Alice) and (N Bob))</a><br />
			<a class="example" href="?i=(S(NP(N Alice))(VP(V is)(NP(N'(N a student)(PP^ of physics">(S(NP(N Alice))(VP(V is)(NP(N'(N a student)(PP^ of physics</a><br />
			<a class="example" href="?i=(S (X-a Movement) (Y example &lt;a&gt;))">(S (X-a Movement) (Y example &lt;a&gt;))</a>
		</div>
	</div>
	<br />

	<div id="image-goes-here"></div>


<style type="text/css">
body { font-size: small !important; font-family: sans-serif; margin: 20px; background-color: #ffffff}
#accordion { margin: 0px auto; width: 500px; text-align: center; }
table { margin: 0px auto; }
//.ui-widget { font-size:small !important; }
td {font-size:small !important;}
textarea {resize: vertical; width: 100%}
a.example { text-decoration: none; color: #4183C4!important; }
.help {text-align: left;}
#image-goes-here { text-align: center; }
img { border: 1px solid #bbbbbb; }
.nobr { white-space: nowrap; }
</style>

<link type="text/css" href="css/cupertino/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="js/base64.js"></script>
<script type="text/javascript" src="js/canvas2image.js"></script>
<script type="text/javascript" src="js/syntree.js"></script>
<script type="text/javascript">

function handler(font_size_update, vert_space_update, hor_space_update) {
try {
	// Initialize the various options.
	var term_font = "";
	var nonterm_font = "";
	var color = false;
	var term_lines = false;
	if (document.getElementById("term-ital").checked)
		term_font = term_font + "italic ";
	if (document.getElementById("term-bold").checked)
		term_font = term_font + "bold ";
	if (document.getElementById("nonterm-ital").checked)
		nonterm_font = nonterm_font + "italic ";
	if (document.getElementById("nonterm-bold").checked)
		nonterm_font = nonterm_font + "bold ";
	if (document.getElementById("color-check").checked)
		color = true;
	if (document.getElementById("term-lines").checked)
		term_lines = true;
	font_size = $("#font-size-slider").slider( "option", "value" );
	vert_space = $("#vert-space-slider").slider( "option", "value" );
	hor_space = $("#hor-space-slider").slider( "option", "value" );
	if (font_size_update) font_size = font_size_update;
	if (vert_space_update) vert_space = vert_space_update;
	if (hor_space_update) hor_space = hor_space_update;
	term_font = term_font + font_size + "pt ";
	nonterm_font = nonterm_font + font_size + "pt ";
	term_font = term_font + $('input:radio[name=font-style]:checked').val();
	nonterm_font = nonterm_font + $('input:radio[name=font-style]:checked').val();
	
	// Get the string.
	var str = document.getElementById("i").value;
	
	/*$("#image-goes-here").text(str + ", " + font_size + ", " + 
		term_font + ", " + nonterm_font + ", " + vert_space + ", " + hor_space);*/
	
	var img = go(str, font_size, term_font, nonterm_font, vert_space, hor_space, color, term_lines);
	$("#image-goes-here").empty();
	$("#image-goes-here").append(img);
	
} catch (err) {
	if (debug) {
		throw(err);
	} else { 
		if (err == "canvas")
			$("#image-goes-here").text("Browser not supported.");
	}
} // try-catch
return false;
} // handler()

$(function() {
	// UI
	$("#make-link, #color-check, #term-lines").button();
	$("#font-size-slider").slider({value: 12, min: 8, max: 16, step: 1});
	$("#vert-space-slider").slider({value: 35, min: 35, max: 70, step: 5});
	$("#hor-space-slider").slider({value: 10, min: 10, max: 50, step: 5});
	$("#font-style-radio, #term-font-check, #nonterm-font-check").buttonset();
	$("#accordion").accordion({collapsible: true, icons: false, autoHeight: false});
	
	try {
		var qs = decodeURIComponent(window.location.search.slice(1));
		qs = qs.replace(/^i=/,"");
		qs = qs.replace(/\+/g," ");
		if (qs == "") throw "";
		document.getElementById("i").value = qs;
	} catch (err) {}
	
	handler();
	
	// Events
	$("#i").keypress(function() {handler(); return true;});
	$("#i").keyup(function() {handler(); return true;});
	$("#i").keydown(function() {handler(); return true;});
	$("#i").change(function() {handler(); return true;});
	$(".redraw").change(function() {return handler()});
	$("#make-link").click(function() {
		var loc = window.location.href;
		loc = loc.replace(window.location.search, "");
		
		window.prompt ("Link for this tree:", loc + "?i=" +
			encodeURIComponent(document.getElementById("i").value));
		return false;
	});
	$("#font-size-slider").bind("slide", function (event, ui) {
		handler(ui.value, null, null); return true;
	});
	$("#vert-space-slider").bind("slide", function (event, ui) {
		handler(null, ui.value, null); return true;
	});
	$("#hor-space-slider").bind("slide", function (event, ui) {
		handler(null, null, ui.value); return true;
	});
});
</script>

</body>
</html>
