<footer class="admin-footer mt-5 py-3 px-4 text-muted d-flex justify-content-between align-items-center flex-wrap">
  
  <small>
    &copy; {{ date('Y') }}
    <span class="text-success fw-semibold">
        {{ $setting->site_name ?? 'Layla School' }}
    </span>
    | Dashboard Admin 💻
  </small>

  <div class="d-flex align-items-center gap-3 small mt-2 mt-md-0">
    <span>👤 Login sebagai: <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
    <span id="clock" class="fw-semibold text-success"></span>
  </div>

</footer>

<style>
.admin-footer {
  background: #f9fdfb;
  border-top: 1px solid #d1e7dd;
  font-size: 0.9rem;
  letter-spacing: 0.3px;
  width: 100%;
}

.admin-footer small {
  color: #6c757d;
}

#clock {
  font-family: monospace;
}
</style>

<script>
function updateClock() {
  const now = new Date();
  const h = String(now.getHours()).padStart(2, '0');
  const m = String(now.getMinutes()).padStart(2, '0');
  const s = String(now.getSeconds()).padStart(2, '0');

  const clock = document.getElementById('clock');
  if(clock){
    clock.textContent = `${h}:${m}:${s}`;
  }
}

setInterval(updateClock, 1000);
updateClock();
</script>