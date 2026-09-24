<?php
class Movie {
    private $id;
    private $title;
    private $price;
    private $totalSeats;
    private $availableSeats;

    public function __construct($id, $title, $price, $totalSeats) {
        if (!is_numeric($price) || $price < 0) {
            throw new InvalidArgumentException("Giá vé phải là số không âm.");
        }
        if (!is_int($totalSeats) || $totalSeats <= 0) {
            throw new InvalidArgumentException("Tổng số ghế phải là số nguyên dương.");
        }

        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }

    public function bookTicket($quantity) {
        if (!is_int($quantity) || $quantity <= 0) {
            throw new InvalidArgumentException("Số lượng vé đặt phải là số nguyên dương.");
        }
        if ($quantity > $this->availableSeats) {
            throw new RuntimeException("Không đủ ghế trống để đặt vé cho phim \"{$this->title}\".");
        }
        $this->availableSeats -= $quantity;
        return true;
    }

    public function cancelTicket($quantity) {
        if (!is_int($quantity) || $quantity <= 0) {
            throw new InvalidArgumentException("Số lượng vé hủy phải là số nguyên dương.");
        }
        $soldSeats = $this->getSoldSeats();
        if ($quantity > $soldSeats) {
            throw new RuntimeException("Không thể hủy nhiều hơn số vé đã bán của phim \"{$this->title}\".");
        }
        $this->availableSeats += $quantity;
        return true;
    }

    public function getSoldSeats() {
        return $this->totalSeats - $this->availableSeats;
    }

    public function getRevenue() {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo() {
        echo "<tr>";
        echo "<td>" . $this->id . "</td>";
        echo "<td>" . htmlspecialchars($this->title) . "</td>";
        echo "<td>" . number_format($this->price) . "</td>";
        echo "<td>" . $this->totalSeats . "</td>";
        echo "<td>" . $this->availableSeats . "</td>";
        echo "<td>" . $this->getSoldSeats() . "</td>";
        echo "<td>" . number_format($this->getRevenue()) . "</td>";
        echo "</tr>";
    }
}
?>