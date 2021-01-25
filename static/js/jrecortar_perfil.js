// 
function cargar_jcrop(){
	// console.log($('#img_1'));
	if ($("#jcrop_curso").length > 0) {
		$('#img_1').Jcrop({
			onChange: showCoords,
			onSelect: showCoords,
			aspectRatio: 360/264,
			setSelect : [0, 0, 360, 264],
		});
	}
	//
	if ($("#jcrop_otro").length > 0) {
		$('#img_1').Jcrop({
			onChange: showCoords,
			onSelect: showCoords,
			aspectRatio: 1,
			setSelect : [0, 0, 250, 250],
		});
	}
}
//
function showCoords(c)
{
	$('input[name="x"]').val(c.x);
	$('input[name="y"]').val(c.y);
	$('input[name="w"]').val(c.w);
	$('input[name="h"]').val(c.h);
};
// 
