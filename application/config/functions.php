<?php

class functions extends connection {

	function selectAll($query) {
		$statement = $this->connect()->query($query);
		return $statement->fetchAll();

	}

	function setID($column_id, $table_name) {
		$query = "SELECT MAX($column_id) FROM $table_name";
		$count_row = $this->connect()->query($query)->fetchColumn() + 1;
		
		if ($count_row == 1) {
			$count_row = 100001;
		}
		return $count_row;

	}

	function setOrderID($column_id, $table_name) {
		$query = "SELECT MAX($column_id) FROM $table_name";
		$count_row = $this->connect()->query($query)->fetchColumn() + 1;
		
		if ($count_row == 1) {
			$count_row = 702001;
		}
		return $count_row;

	}

	function getData($table_name, $column_id, $id) {
		$query = "SELECT * FROM $table_name WHERE $column_id = :id";
		$statement = $this->connect()->prepare($query);
		$statement->execute(['id' => $id]);
		return $statement->fetch();

	}

	function searchInCart($data) {
		$query = "SELECT * FROM cart WHERE cart_code = :cart_code AND user_id = :user_id AND product_id = :product_id";
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);
		return $statement->fetch();

	}

	function getCartSubtotal($data) {
		$query = "SELECT SUM(products.price * cart.quantity) AS 'subtotal' FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.cart_code = 0 AND cart.user_id = :user_id";
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);
		return $statement->fetch();

	}

	function searchInOrders($data) {
		$query = "SELECT orders.order_id ,orders.contact, orders.address, orders.total, (790.00) AS delivery, (orders.total - 790.00) AS 'subtotal', orders.ordered_date, users.firstname, users.lastname, users.email FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.order_id = :order_id";
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);
		return $statement->fetch();
	}


	function insert($query, $data) {
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);

	}

	function update($query, $data) {
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);

	}

	function delete($query, $data) {
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);

	}

	function signin($query, $data) {
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);
		return $statement->fetch();

	}

	function rowCount($table_name) {
		$query = "SELECT COUNT(*) FROM $table_name";
		return $this->connect()->query($query)->fetchColumn();

	}

	function itemCount($query, $data) {
		$statement = $this->connect()->prepare($query);
		$statement->execute($data);
		return $statement->rowCount();

	}

}

$function = new functions();