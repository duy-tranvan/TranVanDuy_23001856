// Component thẻ sản phẩm: dữ liệu hiển thị lấy từ props,
// trạng thái mở mô tả nằm trong data() riêng của từng thẻ.
const TheSanPham = {
  props: {
    ten:    { type: String, required: true },     // bắt buộc
    gia:    { type: Number, required: true },     // bắt buộc
    anh:    { type: String, default: '' },        // có giá trị mặc định
    moTa:   { type: String, default: 'Chưa có mô tả cho sản phẩm này.' },
    tonKho: { type: Number, default: 0 }
  },
  emits: ['mua'],
  data() {
    return { dangMoMoTa: false };                 // mỗi thẻ có bản riêng
  },
  computed: {
    hetHang() { return this.tonKho <= 0; },
    giaHienThi() { return new Intl.NumberFormat('vi-VN').format(this.gia) + ' đ'; }
  },
  methods: {
    batTatMoTa() { this.dangMoMoTa = !this.dangMoMoTa; },
    mua() { if (!this.hetHang) this.$emit('mua', this.ten); }
  },
  template: `
    <article class="the" :class="{ 'het-hang': hetHang }">
      <div class="anh">
        <img v-if="anh" :src="anh" :alt="ten">
        <div v-else class="anh-trong">Chưa có ảnh</div>
        <span v-if="hetHang" class="nhan het">Hết hàng</span>
      </div>
      <div class="noi-dung">
        <h2>{{ ten }}</h2>
        <p class="gia">{{ giaHienThi }}</p>
        <p class="ton">{{ hetHang ? 'Không còn hàng' : 'Còn ' + tonKho + ' sản phẩm' }}</p>
        <p v-if="dangMoMoTa" class="mo-ta">{{ moTa }}</p>
        <div class="nut">
          <button type="button" class="phu" @click="batTatMoTa">
            {{ dangMoMoTa ? 'Ẩn mô tả' : 'Xem mô tả' }}
          </button>
          <button type="button" :disabled="hetHang" @click="mua">
            {{ hetHang ? 'Hết hàng' : 'Mua' }}
          </button>
        </div>
      </div>
    </article>
  `
};
