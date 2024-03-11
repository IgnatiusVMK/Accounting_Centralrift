document.getElementById('button_modal').addEventListener("click",
function(){
    document.querySelector('.bg-modal').style.display = "flex";
}); 


document.querySelector('.close').addEventListener("click",
function(){
    window.location.href='tables.php';
});

// document.querySelector('.close').addEventListener("click",
// function(){
//     document.querySelector('.bg-modal').style.display = "none";
// });