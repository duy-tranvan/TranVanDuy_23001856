const SL_MIN = 1;
const SL_MAX = 99;

// Dữ liệu kiểm tra: 2 bút x 5.000 + 3 vở x 12.000 = 46.000 đ, tổng 5 sản phẩm
function duLieuMau() {
  return [
    { id: 1, ten: 'Bút bi', donGia: 5000, soLuong: 2 },
    { id: 2, ten: 'Vở kẻ ngang', donGia: 12000, soLuong: 3 }
  ];
}

const app = Vue.createApp({
  data() {
    return { gioHang: duLieuMau(), loi: '' };
  },
  computed: {
    tongSoLuong() {
      return this.gioHang.reduce((s, m) => s + m.soLuong, 0);
    },
    tongTien() {
      return this.gioHang.reduce((s, m) => s + m.donGia * m.soLuong, 0);
    }
  },
  methods: {
    dinhDangTien(n) { return new Intl.NumberFormat('vi-VN').format(n) + ' đ'; },

    // Cha là nơi duy nhất sửa mảng, sau khi kiểm tra dữ liệu từ con
    xuLyDoiSoLuong(id, soLuongMoi) {
      const muc = this.gioHang.find(m => m.id === id);
      if (!muc) return;
      if (!Number.isInteger(soLuongMoi) || soLuongMoi < SL_MIN || soLuongMoi > SL_MAX) {
        this.loi = 'Số lượng của "' + muc.ten + '" phải là số nguyên từ ' + SL_MIN + ' đến ' + SL_MAX + '.';
        return;
      }
      this.loi = '';
      this.gioHang = this.gioHang.map(m =>
        m.id === id ? { ...m, soLuong: soLuongMoi } : m
      );
    },
    xuLyXoa(id) {
      this.loi = '';
      this.gioHang = this.gioHang.filter(m => m.id !== id);
    },
    khoiPhuc() {
      this.loi = '';
      this.gioHang = duLieuMau();
    }
  }
});

app.component('dong-gio-hang', DongGioHang);
app.mount('#app');
