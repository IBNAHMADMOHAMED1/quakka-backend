
create table if not exists clients(
    id int not null auto_increment,
    first_name varchar(255) not null,
    last_name varchar(255) not null,
    email varchar(255) not null,
    mailing_address varchar(255) not null,
    phone number(20) not null,
    city varchar(255) not null,
    postal_code varchar(255) not null,
    country varchar(255) not null,
    primary key(id)

);

create table if not exists subscribes(
    id int not null auto_increment,
    email varchar(255) not null,
    primary key(id)
    unique(email)
);

create table if not exists payments(
    id int not null auto_increment,
    client_id int not null,
    amount int not null,
    primary key(id)
    foreign key(client_id) references clients(id)
);

create table if not exists shippings (
    id int not null auto_increment,
    client_id int not null,
    amount int not null
    primary key(id),
    foreign key(client_id) references clients(id),
    unique(client_id)
);




create table if not exists list_of_products(
    id int not null auto_increment,
    product_id int not null,
    client_id int not null,
    primary key(id),
    foreign key(product_id) references products(id),
    foreign key(client_id) references clients(id)
);
create table if not exists users (
    id int not null auto_increment,
    username varchar(255) not null,
    email varchar(255) not null,
    phoneNumber number(20) not null,
    mailing_address varchar(255) not null,
    city varchar(255) not null,
    password varchar(255) not null,
    primary key(id),
    unique(email)
);

create table if not exists shippings(
    id int not null auto_increment,
    client_id int not null,
    shipping_name varchar(255) not null,
    list_of_products_id int not null,
    primary key(id),
    foreign key(client_id) references clients(id),
    foreign key(list_of_products_id) references list_of_products(id)

);

create table if not exists payments(
    id int not null auto_increment,
    client_id int not null,
    amount int not null,
    primary key(id),
    foreign key(client_id) references clients(id)
);
create table if not exists shippingsDetails(
    id int not null auto_increment,
    shipping_name varchar(255) not null,
    email varchar(255) not null,
    phone number(20) not null,
    mailing_address varchar(255) not null,
    city varchar(255) not null,
    postal_code varchar(255) not null,
    country varchar(255) not null,
    primary key(id),
  
)

create table if not exists pricing_table(
    id int not null auto_increment,
    shippingID int not null,
    productListID int not null,
    amount int not null,
    primary key(id),
    foreign key(shippingID) references shippingsDetails(id),
    foreign key(productListID) references list_of_products(id)
);

create table if not exists orders(
    id int not null auto_increment,
    client_id int not null,
    shipping_id int not null,
    total_amount int not null,
    list_of_products int not null,
    primary key(id),
    foreign key(client_id) references clients(id),
    foreign key(shipping_id) references shippingsDetails(id),
    foreign key(list_of_products) references list_of_products(id)
    
);

create table if not exists blogs(
    id int not null auto_increment,
    title varchar(255) not null,
    content varchar(255) not null,
    created_at datetime not null,
    primary key(id)
)

create table if not exists commands(
    id int not null auto_increment,
    client_id int not null,
    hall_id int not null,
    date_arrival datetime current_timestamp,
    date_departure datetime current_timestamp,
    created_at datetime not null,  
    primary key(id),
    foreign key(hall_id) references halls(id),
    foreign key(client_id) references clients(id)
)
   

