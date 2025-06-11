<!-- 🌟 MODAL XEM TRƯỚC VÀ CHỈNH SỬA SỰ KIỆN -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="confirmAddForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="previewLabel">📝 Xem trước sự kiện Google Calendar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-2">
            <label>📌 Tên sự kiện</label>
            <input type="text" class="form-control" name="title" required>
          </div>
          <div class="mb-2">
            <label>📍 Địa điểm</label>
            <input type="text" class="form-control" name="location">
          </div>
          <div class="mb-2">
            <label>📝 Mô tả</label>
            <textarea class="form-control" name="description"></textarea>
          </div>
          <div class="mb-2">
            <label>🕒 Thời gian (ví dụ: 08:00 -> 10:00)</label>
            <input type="text" class="form-control" name="time_range">
          </div>
          {{-- Trường ẩn --}}
          <input type="hidden" name="day_index">
          <input type="hidden" name="type">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ Hủy</button>
          <button type="submit" class="btn btn-success">✅ Xác nhận thêm</button>
        </div>
      </div>
    </form>
  </div>
</div>
