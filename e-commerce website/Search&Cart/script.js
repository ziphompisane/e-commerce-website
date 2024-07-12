let products = {
    data: [
      {
        productName: "Kelvin Momo Kurhula",
        category: "amapiano",
        price: "30",
        image: "images/1.jpg",
      },
      {
        productName: "Kelvin Momo Ivy League",
        category: "amapiano",
        price: "30",
        image: "images/3.jpg",
      },
      {
        productName: "Kelvin Momo Amukelani",
        category: "amapiano",
        price: "30",
        image: "images/2.jpg",
      },
      {
        productName: "Drake For all the Dogs",
        category: "hip-hop",
        price: "30",
        image: "images/4.jpeg",
      },
      {
        productName: "Drake Her Loss",
        category: "hip-hop",
        price: "30",
        image: "images/6.jpeg",
      },
      {
        productName: "Kanye West Vultures",
        category: "hip-hop",
        price: "30",
        image: "images/5.jpeg",
      },
      {
        productName: "50 Cent- Get Rich or Die Tryin",
        category: "hip-hop",
        price: "120",
        image: "images/7.jpeg",
      },
      {
        productName: "The Miseducation of Lauryn Hill",
        category: "hip-hop",
        price: "500",
        image: "images/9.jpeg",
      },
      {
        productName: "Beyonce - CowBoy Carter",
        category: "country",
        price: "200",
        image: "images/13.jpeg",
      },
      {
        productName: "Chris Stapleton - Higher",
        category: "country",
        price: "225",
        image: "images/12.jpeg",
      },
      {
        productName: "Chris Stapleton - Traveller",
        category: "country",
        price: "120",
        image: "images/11.jpeg",
      },
      {
        productName: "Burna Boy - African Giant",
        category: "afro-beat",
        price: "120",
        image: "images/14.jpeg",
      },
      {
        productName: "Wizkid - Made In Lagos",
        category: "afro-beat",
        price: "120",
        image: "images/16.jpeg",
      },
      {
      productName: "Prince- Sign O' The Times",
        category: "r&b",
        price: 320,
        image: "images/17.jpg",
      },
      { 
       productName: "Michael Jackson -Thrille",
       category: "r&b",
        price: 350,
        image: "images/18.jpg",
    },
    {
        productName: "Tupac - All eyez on Me",
        category: "hip-hop" ,
        price: 350,
        image: "images/10.jpg",
    }
  ]
  };
  
  for (let i of products.data) {
    //Create Card
    let card = document.createElement("div");
    //Card should have category and should stay hidden initially
    card.classList.add("card", i.category, "hide");
    //image div
    let imgContainer = document.createElement("div");
    imgContainer.classList.add("image-container");
    //img tag
    let image = document.createElement("img");
    image.setAttribute("src", i.image);
    imgContainer.appendChild(image);
    card.appendChild(imgContainer);
    //container
    let container = document.createElement("div");
    container.classList.add("container");
    //product name
    let name = document.createElement("h5");
    name.classList.add("product-name");
    name.innerText = i.productName.toUpperCase();
    container.appendChild(name);
    //price
    let price = document.createElement("h6");
    price.innerText = "$" + i.price;
    container.appendChild(price);
  
    card.appendChild(container);
    document.getElementById("products").appendChild(card);
  }
  
  //parameter passed from button (Parameter same as category)
  function filterProduct(value) {
    //Button class code
    let buttons = document.querySelectorAll(".button-value");
    buttons.forEach((button) => {
      //check if value equals innerText
      if (value.toUpperCase() == button.innerText.toUpperCase()) {
        button.classList.add("active");
      } else {
        button.classList.remove("active");
      }
    });
  
    //select all cards
    let elements = document.querySelectorAll(".card");
    //loop through all cards
    elements.forEach((element) => {
      //display all cards on 'all' button click
      if (value == "all") {
        element.classList.remove("hide");
      } else {
        //Check if element contains category class
        if (element.classList.contains(value)) {
          //display element based on category
          element.classList.remove("hide");
        } else {
          //hide other elements
          element.classList.add("hide");
        }
      }
    });
  }
 
  //Search button click
  document.getElementById("search").addEventListener("click", () => {
    //initializations
    let searchInput = document.getElementById("search-input").value;
    let elements = document.querySelectorAll(".product-name");
    let cards = document.querySelectorAll(".card");
  
    //loop through all elements
    elements.forEach((element, index) => {
      //check if text includes the search value
      if (element.innerText.includes(searchInput.toUpperCase())) {
        //display matching card
        cards[index].classList.remove("hide");
      } else {
        //hide others
        cards[index].classList.add("hide");
      }
    });
  });
  
  //Initially display all products
  window.onload = () => {
    filterProduct("all");
  };
  