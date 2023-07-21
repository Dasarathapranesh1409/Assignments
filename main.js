define(['knockout'], function (ko) {
    
    function Product(name, description, price, type,image) {
      this.name = name;
      this.description = description;
      this.price = price;
      this.type = type;
      this.image = image;
      this.quantity = 1; 
    }

    var products = [
      new Product("Thoor Dhall", "Toor dal is rich in protein that might help avoid type 2 diabetes.", "$8.99", "grossary",'thoordhall.jpeg' ),
      new Product("Gram Dhall", "Gram dal is a good source of folic acid. It has a good fiber content and helps in digestion", "$11.99", "grossary",'gramdhall.jpeg'),
      new Product("Mustard", "Mustard contains antioxidants and other beneficial plant compounds thought to help protect your body against damage and disease.", "$13.99", "grossary",'mustard.jpeg'),
      new Product("Sunflower Oil", "Sunflower oil is pressed from the seeds of the sunflower plant (Helianthus annuus). It contains high amounts of the essential fatty acid, linoleic acid", "$10.99", "grossary",'oil.jpeg'),
      new Product("Turmeric", "Turmeric — and especially its most active compound, curcumin — have many scientifically proven health benefits, such as the potential to improve heart health and prevent against Alzheimer's and cancer.", "$12.99", "grossary",'turmeric.jpeg'),
      new Product("Pepper", "Black pepper helps to stimulate hydrochloric acid in your stomach so you can better digest and absorb the foods you ", "$9.99", "grossary",'pepper.jpeg'),
      new Product("Badham", "Almonds can help lower your systolic blood pressure, which offers even more protection against heart disease.", "$14.99", "Nuts",'badham.jpeg'),
      new Product("Cashewnut", "Cashew is used for diabetes, high cholesterol, heart disease, stomach and intestinal (gastrointestinal) ailments, skin problems,", "$16.99", "Nuts",'cashew.jpeg'),
      new Product("Dry Grapes", "Grapes are a good source of potassium, a mineral that helps balance fluids in your body. ", "$10.99", "Nuts",'drygrapes.jpeg'),
      new Product("Groundnut", "Groundnut seed can be consumed raw (non-heated), boiled, and roasted and also used to make confections and its flour to make baked products", "$12.99", "Nuts",'groundnut.jpeg'),
      new Product("Pista", "The edible seeds of the Pistacia vera tree are a good source of protein, fibre, antioxidants, and beneficial fats.", "$12.99", "Nuts",'pista.jpeg'),
      new Product("dates","The antioxidants, minerals, and vitamins in dates help support brain, digestive, and heart health and protect against disease. ","$12","Nuts","dates.jpeg"),
      new Product("Carrot","It is crunchy, tasty, and highly nutritious. Carrots are a particularly good source of beta carotene, fiber, vitamin K1, potassium, and antioxidants ( 1 )","$12","Vegetables","carrot.jpeg"),
      new Product("Garlic","Garlic is widely recognized for its ability to fight bacteria, viruses, fungi, and even parasites","$12","Vegetables","garlic.jpeg"),
      new Product("Ladyfinger","Lady finger is good for digestion as it has high fiber content and it prevents constipation due to its laxative property.","$4","Vegetables","ladyfinger.jpeg"),
      new Product("Onion","The onion bulb is commonly eaten as food. Onion bulb and extract are also used to make medicine.","$6","Vegetables","onion.jpeg"),
      new Product("Tomato","People use tomato for cancer prevention, diabetes, high blood pressure, heart disease, osteoarthritis, and many other","$60","Vegetables","tomato.jpeg"),
      new Product("Cucumber","They are ideal for detoxification and preventing dehydration. Cucumbers are rich in phytonutrients and vitamin K","$10","Vegetables","cucumber.jpeg"),
      new Product("Brinjal","Brinjal may help to lower the risk of many heart diseases such as heart attack and stroke by apparently reducing the damage caused by free radicals","$5","Vegetables","brinjal.jpeg"),
      new Product("potato","They're rich in vitamin C, which is an antioxidant. Potatoes were a life-saving food source in early times because the vitamin C prevented scurvy","$15","Vegetables","potato.jpeg"),
      new Product("Fenugreek", "Fenugreek (Trigonella foenum-graecum) is an herb similar to clover. The seeds taste similar to maple syrup and are used in foods and medicine.", "$9.99", "grossary",'fenugreek.jpeg'),
      new Product("Millets", "Millets are a rich source of fibre, minerals like magnesium, phosphorous, iron, calcium, zinc and potassium ", "$19.99", "grossary",'millet.jpeg'),
      new Product("HazleNut", "Hazelnut contains oil, protein, fiber, and antioxidants. The antioxidants in hazelnut might have heart health benefits.", "$12.99", "Nuts",'hazlenut.jpeg'),
      new Product("PineNut", "These tiny seeds pack a variety of nutrients essential to your health, including vitamins, minerals, and heart-healthy fats.", "$12.99", "Nuts",'pinenut.jpeg'),
    ];

    function ProductViewModel() {
      var self = this;

      self.foodTypes = ko.observableArray(["All", "grossary", "Nuts","Vegetables"]);
      self.selectedFoodType = ko.observable("All");

      self.currentPage = ko.observable(0);
      self.pageSize = 4;
      self.pageButtonsToShow = 4;

      self.filteredProducts = ko.computed(function() {
        var selectedType = self.selectedFoodType();

        if (selectedType === "All") {
          return products;
        } else {
          return products.filter(function(product) {
            return product.type === selectedType;
          });
        }
      });

      self.totalPages = ko.computed(function() {
        return Math.ceil(self.filteredProducts().length / self.pageSize);
      });

      self.displayedProducts = ko.computed(function() {
        var startIndex = self.currentPage() * self.pageSize;
        return self.filteredProducts().slice(startIndex, startIndex + self.pageSize);
      });

      self.filterProducts = function() {
        self.currentPage(0);
      };

      self.nextPage = function() {
        if (self.currentPage() < self.totalPages() - 1) {
          self.currentPage(self.currentPage() + 1);
        }
      };

      self.previousPage = function() {
        if (self.currentPage() > 0) {
          self.currentPage(self.currentPage() - 1);
        }
      };

      self.goToPage = function(pageIndex) {
        self.currentPage(pageIndex);
      };

      self.cartItems = ko.observableArray([]);

      self.addToCart = function(product) {
        self.cartItems.push(product);
        var cartData = ko.toJSON(self.cartItems());
        console.log("cart",cartData)
        localStorage.setItem("cart",cartData);
        
      };

      self.viewCart = function() {
        var cartData = ko.toJSON(self.cartItems());
        // localStorage.setItem('cart', cartData);
        window.location.href = 'cart.html';
      };
    }

    ko.applyBindings(new ProductViewModel());
    return {
        ProductViewModel: ProductViewModel,
      };
    });
  