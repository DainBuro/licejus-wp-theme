const newsSection = document.querySelector(".home-news");

if (newsSection) {
  const categoryButtons = newsSection.querySelectorAll(".category-select-btn");
  const allNewsButton = newsSection.querySelector("#all-news-button");
  const newsContent = newsSection.querySelector(".content");

  if (allNewsButton) {
    allNewsButton.classList.add("active");
  }

  const setActive = (btn) => {
    categoryButtons.forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
  };

  const fetchNews = async (category) => {
    const config = window.licejusNews;
    if (!config || !config.ajax_url) return;

    newsSection.classList.add("is-loading");

    const body = new URLSearchParams();
    body.append("action", "filter_news");
    body.append("nonce", config.nonce);
    body.append("category", category);

    try {
      const response = await fetch(config.ajax_url, {
        method: "POST",
        credentials: "same-origin",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body,
      });

      const result = await response.json();
      if (result && result.success && newsContent) {
        newsContent.innerHTML = result.data.html;
      }
    } catch (error) {
      console.error("News filter request failed:", error);
    } finally {
      newsSection.classList.remove("is-loading");
    }
  };

  categoryButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      if (btn.classList.contains("active")) return;
      setActive(btn);
      fetchNews(btn.dataset.category || "all");
    });
  });
}
