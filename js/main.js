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
const ChangeText = (element) => {
    const title = document.querySelector(element + " span");
    var onChaning = false;
    var newvalue;
    const Ondblick = function (){
        if(!onChaning) {
            onChaning = true;
            this.innerHTML = "<input type='text' value='" + this.innerHTML + "'>";
        }
    };
    const onFocusOut = function (){
    newvalue = document.querySelector(element + " span input").value;
        this.innerHTML = newvalue;
        onChaning = false;
    };

    title.addEventListener("dblclick", Ondblick);
    title.addEventListener("focusout", onFocusOut);
}
ChangeText(".list_card-header");
ChangeText(".list_card-info");