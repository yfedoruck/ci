CREATE TABLE urls (
url_id int PRIMARY KEY NOT NULL,
url_code varchar(10) NOT NULL,
url_address text NOT NULL,
url_created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);