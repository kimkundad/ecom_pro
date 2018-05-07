function optionCreateElement(){
  var option=document.getElementById('option');
  var optionElement=document.createElement('input');
      optionElement.setAttribute('type',"text");
      optionElement.setAttribute('name',"option[]");
     //myElement1.setAttribute('id',"option[]");
      option.appendChild(optionElement);	   
}
function option_insertCreateElement(){
  var option_insert=document.getElementById('option_insert');
  var option_insertElement=document.createElement('input');
      option_insertElement.setAttribute('type',"text");
      option_insertElement.setAttribute('name',"option_insert[]");
      option_insert.appendChild(option_insertElement);	   
}
function product_imageCreateElement(){
  var product_image=document.getElementById('product_image');
  var product_imageElement=document.createElement('input');
	  product_imageElement.setAttribute('type',"file");
	  product_imageElement.setAttribute('name',"product_image[]");
	  product_image.appendChild(product_imageElement);	   
}