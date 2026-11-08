// Ảnh mẫu dạng SVG nhúng sẵn để không phụ thuộc mạng
function anhMau(chu, mau) {
  const svg =
    '<svg xmlns="http://www.w3.org/2000/svg" width="320" height="200">' +
    '<rect width="100%" height="100%" fill="' + mau + '"/>' +
    '<text x="50%" y="54%" font-family="Segoe UI, sans-serif" font-size="30" ' +
    'fill="#ffffff" text-anchor="middle">' + chu + '</text></svg>';
  return 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svg);
}

const app = Vue.createApp({
  data() {
    return {
      thongBao: '',
      danhSach: [
        { id: 1, ten: 'Bánh Oreo', gia: 25000, tonKho: 120,
          anh: anhMau('Bánh Oreo', '#3b4a6b'),
          moTa: 'Bánh quy socola kẹp kem vani, gói 133g.' },
        { id: 2, ten: 'Nước cam Teppy', gia: 12000, tonKho: 80,
          anh: anhMau('Nước cam Teppy', '#d9822b'),
          moTa: 'Nước cam ép có tép, chai 327ml.' },
        { id: 3, ten: 'Cà phê G7', gia: 55000, tonKho: 0,
          anh: anhMau('Cà phê G7', '#6b4a35'),
          moTa: 'Cà phê hòa tan 3 trong 1, hộp 18 gói.' },
        { id: 4, ten: 'Mì Hảo Hảo', gia: 4500, tonKho: 500,
          anh: anhMau('Mì Hảo Hảo', '#b3382c'),
          moTa: 'Mì ăn liền vị tôm chua cay, gói 75g.' },
        // Không truyền anh và moTa -> dùng giá trị mặc định của prop
        { id: 5, ten: 'Dầu ăn Simply', gia: 62000, tonKho: 35 }
      ]
    };
  },
  methods: {
    xuLyMua(ten) {
      this.thongBao = 'Đã thêm "' + ten + '" vào giỏ hàng.';
    }
  }
});

// Đăng ký component trước khi mount
app.component('the-san-pham', TheSanPham);
app.mount('#app');
