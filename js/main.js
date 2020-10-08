const dragAndDrop = () => {
    const card = document.querySelector(".js-card");
    const cells = document.querySelectorAll(".js-cell");
    const  dragStart = function (){
      setTimeout(() => {
          this.classList.add("hide");
      }, 0);
    };
    const dragEnd = function (){
        this.classList.remove('hide');
    };
    const dragOver = function (evt){
      evt.preventDefault();
    };
    const dragEnter = function (evt){
        evt.preventDefault();
       this.classList.add("hovered");
    };
    const dragLeave = function (){
        this.classList.remove("hovered");
    };
    const dragDrop = function (){
        this.append(card);
        this.classList.remove("hovered");
    };
    cells.forEach((cell) =>{
       cell.addEventListener('dragover', dragOver);
       cell.addEventListener('dragenter', dragEnter);
       cell.addEventListener('dragleave', dragLeave);
        cell.addEventListener('drop', dragDrop);
    })
    card.addEventListener("dragstart", dragStart);
    card.addEventListener("dragend", dragEnd);
}
dragAndDrop();
const ChangeText = (element, maxlenght) => {
    const title = document.querySelector(element + " span");
    var onChaning = false;
    var newvalue;
    var oldvalue;
    const Ondblick = function (){
        if(!onChaning) {
            onChaning = true;
            oldvalue =  this.innerHTML;
            this.innerHTML = "<input type='text' value='" +  oldvalue  + "'>";
        }
    };
    const onFocusOut = function (){
    newvalue = document.querySelector(element + " span input").value;
        var format = /[ `@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/~]/;
        if(format.test(newvalue.replace(/\s/g, ''))){
            alert("No Symbol!");
            newvalue = oldvalue;
        }
        else if(newvalue.length >= maxlenght){
            alert("Too big Text!");
            newvalue = oldvalue;
        }
        this.innerHTML = newvalue;
        onChaning = false;
    };

    title.addEventListener("dblclick", Ondblick);
    title.addEventListener("focusout", onFocusOut);
}
ChangeText(".list_card-header", 25);
ChangeText(".list_card-info", 25);