const countButtons=document.querySelectorAll("button").length;
let products=[];


for(let i=0;i<countButtons;i++){
document.querySelectorAll("button")[i].addEventListener("click",showValue);
}

function showValue(){
// Se hizo un click sobre el Button para comprar una Pizza//

products.push(this.value);

console.log(products);

document.getElementById("badge").setAttribute("value",)

}




//content: attr(value);