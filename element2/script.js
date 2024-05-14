// creating a function
function find(itemFlavor){
    let itemFlavorElement = document.getElementById('itemFlavor');
    let itemSize = document.getElementById('itemSize').value;
    let itemPrice = document.getElementById('itemPrice').value;
    let price = document.getElementById('price');
    console.log(itemSize)
    
    let itemImg = document.querySelector('.proteinImg');
    // the first Condition for maching flavor, size, and price of the protein
    if (itemFlavorElement.value == 'banana' && itemSize == '500g' && itemPrice == '3070' ){
      itemImg.src = 'img/banana.png';
      price.textContent = `price: £65`
      return 'banana protien';
      // the second Condition
    } else if (itemFlavorElement.value == 'Strawberry' && itemSize == '900g' && itemPrice == '7090'){
      itemImg.src = 'img/strawberry.png';
      return 'Strawberry protien';
      // the third Condition
    } else if (itemFlavorElement.value == 'Vanilla' && itemSize == '1200g' && itemPrice == '100200'){
      itemImg.src = 'img/vanilla.png';
      price.textContent = `price: £100.20`
      return 'Vanilla protien';
      // when there is no maching for the previous Condition
    } else if (itemFlavorElement.value == 'unflavor' && itemSize == '1200g' && itemPrice == '18920'){
      itemImg.src = 'img/unflavor.png';
      price.textContent = `price: £89.20`
      return 'unflavor protien';
    }
  }
  
  // getting inputs from the users
  const toggleButton = document.querySelector('#toggleList');
  const listDiv = document.querySelector('.list');
  const userInput = document.querySelector('.userInput');
  const button = document.querySelector('button.description');
  const p = document.querySelector('p.description');
  let listItem = document.querySelectorAll('li');
  const addItemButton = document.querySelector('button.addItemButton');
  const removeItemButton = document.querySelector('button.removeItemButton');
  const listItems = document.getElementsByTagName('li');
  
  // activate an action with event listener
  toggleButton.addEventListener('click', () => {
    if (listDiv.style.display == 'none') {
      listDiv.style.display = 'block';
      toggleButton.textContent = 'Hide list';
    } else {
      listDiv.style.display = 'none';
      toggleButton.textContent = 'cart list';
    }
  });
  
  addItemButton.addEventListener('click', () => {
    let list = document.querySelector('ul');
    let li = document.createElement('li');
    li.textContent = find() || '';
    let appendedItem = list.appendChild(li);
  });
  
  removeItemButton.addEventListener('click', () => {
    let list = document.querySelector('ul');
    let li = document.querySelector('li:last-child');
    list.removeChild(li);;
  });
  
  listDiv.addEventListener('mouseover', (event) => {
    if(event.target.tagName == 'LI') {
      event.target.style.textTransform = 'uppercase';
    }
  });
  
  listDiv.addEventListener('mouseout', (event) => {
    if(event.target.tagName == 'LI') {
      event.target.style.textTransform = 'lowercase';
    }
  });
  