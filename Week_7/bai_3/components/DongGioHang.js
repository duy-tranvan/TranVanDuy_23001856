// Component con: chỉ ĐỌC props, mọi thay đổi gửi lên cha bằng sự kiện.
// Không gán lại props và không sửa thuộc tính của đối tượng `muc`.
const SO_LUONG_TOI_THIEU = 1;
const SO_LUONG_TOI_DA = 99;

const DongGioHang = {
  props: {
    muc: {
      type: Object,
      required: true,
      validator: (m) =>
        typeof m.id === 'number' && typeof m.ten === 'string' &&
        typeof m.donGia === 'number' && typeof m.soLuong === 'number'
    }
  },
  emits: {
    // Khai báo sự kiện và kiểm tra dữ liệu gửi đi
    'doi-so-luong': (id, soLuongMoi) =>
      typeof id === 'number' && typeof soLuongMoi === 'number',
    'yeu-cau-xoa': (id) => typeof id === 'number'
  },
  computed: {
    thanhTien() { return this.muc.donGia * this.muc.soLuong; },
    khongGiamDuoc() { return this.muc.soLuong <= SO_LUONG_TOI_THIEU; },
    khongTangDuoc() { return this.muc.soLuong >= SO_LUONG_TOI_DA; }
  },
  methods: {
    dinhDangTien(n) { return new Intl.NumberFormat('vi-VN').format(n) + ' đ'; },
    tang() { this.$emit('doi-so-luong', this.muc.id, this.muc.soLuong + 1); },
    giam() { this.$emit('doi-so-luong', this.muc.id, this.muc.soLuong - 1); },
    nhapSoLuong(e) {
      const o = e.target;
      this.$emit('doi-so-luong', this.muc.id, Number(o.value));
      // Nếu cha từ chối (giá trị sai), trả ô nhập về số lượng hiện tại
      this.$nextTick(() => { o.value = this.muc.soLuong; });
    },
    xoa() { this.$emit('yeu-cau-xoa', this.muc.id); }
  },
  template: `
    <div class="dong">
      <div class="ten">
        <strong>{{ muc.ten }}</strong>
        <span class="don-gia">{{ dinhDangTien(muc.donGia) }}</span>
      </div>
      <div class="sl">
        <button type="button" class="phu" :disabled="khongGiamDuoc"
                :aria-label="'Giảm số lượng ' + muc.ten" @click="giam">−</button>
        <input type="number" :value="muc.soLuong" min="1" max="99" step="1"
               :aria-label="'Số lượng ' + muc.ten" @change="nhapSoLuong">
        <button type="button" class="phu" :disabled="khongTangDuoc"
                :aria-label="'Tăng số lượng ' + muc.ten" @click="tang">+</button>
      </div>
      <div class="thanh-tien">{{ dinhDangTien(thanhTien) }}</div>
      <button type="button" class="xoa" @click="xoa">Xóa</button>
    </div>
  `
};
