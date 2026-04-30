document.addEventListener("DOMContentLoaded", function () {
  async function postAction(data) {
    const resp = await fetch("actions.php", {
      method: "POST",
      headers: { "X-Requested-With": "XMLHttpRequest" },
      body: data,
    });
    return resp.json();
  }
  // Utility: ensure modal and toast container exist
  function ensureUi() {
    if (!document.getElementById("adminConfirmModal")) {
      const modalHtml = `
      <div class="modal fade" id="adminConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="adminConfirmMessage">Are you sure?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" id="adminConfirmOk">Yes</button>
            </div>
          </div>
        </div>
      </div>`;
      document.body.insertAdjacentHTML("beforeend", modalHtml);
    }

    if (!document.getElementById("adminToastContainer")) {
      const toastHtml = `
      <div id="adminToastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index:1080">
      </div>`;
      document.body.insertAdjacentHTML("beforeend", toastHtml);
    }
  }

  function showToast(message, type = "info") {
    ensureUi();
    const container = document.getElementById("adminToastContainer");
    const bg =
      type === "success"
        ? "bg-success text-white"
        : type === "error"
          ? "bg-danger text-white"
          : "bg-secondary text-white";
    const id = "toast-" + Date.now();
    const html = `
      <div id="${id}" class="toast ${bg}" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>`;
    container.insertAdjacentHTML("beforeend", html);
    const el = document.getElementById(id);
    const toast = new bootstrap.Toast(el, { delay: 4000 });
    toast.show();
    el.addEventListener("hidden.bs.toast", () => el.remove());
  }

  function confirmDialog(message) {
    ensureUi();
    return new Promise((resolve) => {
      const modalEl = document.getElementById("adminConfirmModal");
      const msg = modalEl.querySelector("#adminConfirmMessage");
      const okBtn = modalEl.querySelector("#adminConfirmOk");
      msg.textContent = message;
      const modal = new bootstrap.Modal(modalEl);
      const cleanup = () => {
        okBtn.removeEventListener("click", onOk);
        modalEl.removeEventListener("hidden.bs.modal", onCancel);
      };
      const onOk = () => {
        cleanup();
        modal.hide();
        resolve(true);
      };
      const onCancel = () => {
        cleanup();
        resolve(false);
      };
      okBtn.addEventListener("click", onOk);
      modalEl.addEventListener("hidden.bs.modal", onCancel, { once: true });
      modal.show();
    });
  }

  // Product delete
  document.querySelectorAll(".btn-delete-product").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      const id = btn.dataset.id;
      const confirmed = await confirmDialog("Delete this product?");
      if (!confirmed) return;
      const fd = new FormData();
      fd.append("action", "delete_product");
      fd.append("id", id);
      fd.append("ajax", "1");
      try {
        const res = await postAction(fd);
        if (res.success) {
          const card =
            btn.closest(".product-list-card") ||
            btn.closest('[class*="col-"]') ||
            btn.closest(".card");
          if (card) card.remove();
          showToast("Product deleted", "success");
        } else {
          showToast("Delete failed", "error");
        }
      } catch (err) {
        showToast("Request failed", "error");
      }
    });
  });

  // User delete
  document.querySelectorAll(".btn-delete-user").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      const id = btn.dataset.id;
      const confirmed = await confirmDialog("Delete this user?");
      if (!confirmed) return;
      const fd = new FormData();
      fd.append("action", "delete_user");
      fd.append("id", id);
      fd.append("ajax", "1");
      try {
        const res = await postAction(fd);
        if (res.success) {
          const row = btn.closest("tr") || btn.closest(".list-group-item");
          if (row) row.remove();
          showToast("User deleted", "success");
        } else {
          showToast("Delete failed", "error");
        }
      } catch (err) {
        showToast("Request failed", "error");
      }
    });
  });

  // Toggle role
  document.querySelectorAll(".btn-toggle-role").forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      const id = btn.dataset.id;
      const fd = new FormData();
      fd.append("action", "toggle_role");
      fd.append("id", id);
      fd.append("ajax", "1");
      try {
        const res = await postAction(fd);
        if (res.success) {
          const tr = btn.closest("tr");
          if (tr && res.role) {
            const roleTd = tr.querySelector("td:nth-child(4)");
            if (roleTd) roleTd.textContent = res.role;
          }
          showToast("Role updated", "success");
        } else {
          showToast("Role update failed", "error");
        }
      } catch (err) {
        showToast("Request failed", "error");
      }
    });
  });

  // Order status forms
  document.querySelectorAll(".order-status-form").forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const id = form.dataset.id;
      const status = form.querySelector('select[name="status"]').value;
      const fd = new FormData();
      fd.append("action", "update_order_status");
      fd.append("id", id);
      fd.append("status", status);
      fd.append("ajax", "1");
      try {
        const res = await postAction(fd);
        if (res.success) {
          showToast("Status updated to " + res.status, "success");
        } else {
          showToast("Update failed", "error");
        }
      } catch (err) {
        showToast("Request failed", "error");
      }
    });
  });
});
