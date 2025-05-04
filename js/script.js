// BAGIAN INI DITAMBAHKAN DI AWAL FILE JS
const storageKeys = {
  criteriaInputs: "ahpCriteriaInputs",
  alternativeInputs: "ahpAlternativeInputs",
  results: "ahpResults",
};

const kriteria = window.kriteriaFromPHP;
const alternatif = window.alternatifFromPHP;

console.log("Kriteria dari DB:", kriteria);
console.log("Alternatif dari DB:", alternatif);

const tbody = document.querySelector("#matrixInput tbody");
const thead = document.querySelector("#matrixInput thead tr");
const altTbody = document.querySelector("#alternatifInput tbody");
const altThead = document.querySelector("#alternatifInput thead tr");

// --- Fungsi untuk menyimpan dan memuat data ---

// Menyimpan input perbandingan kriteria
function saveCriteriaInputs() {
  const inputs = {};
  document.querySelectorAll("input[data-i]").forEach((input) => {
    const i = input.dataset.i;
    const j = input.dataset.j;
    inputs[`${i}-${j}`] = input.value;
  });
  localStorage.setItem(storageKeys.criteriaInputs, JSON.stringify(inputs));
  console.log("Criteria inputs saved.");
}

// Menyimpan input nilai alternatif
function saveAlternativeInputs() {
  const inputs = {};
  document.querySelectorAll("input[data-ialt]").forEach((input) => {
    const i = input.dataset.ialt;
    const j = input.dataset.jkrit;
    inputs[`${i}-${j}`] = input.value;
  });
  localStorage.setItem(storageKeys.alternativeInputs, JSON.stringify(inputs));
  console.log("Alternative inputs saved.");
}

// Menyimpan hasil perhitungan
function saveResults(resultsData) {
  localStorage.setItem(storageKeys.results, JSON.stringify(resultsData));
  console.log("Results saved.");
}

// Memuat data dari localStorage saat halaman dimuat
function loadDataFromStorage() {
  console.log("Loading data from storage...");
  // Muat input kriteria
  const savedCriteria = localStorage.getItem(storageKeys.criteriaInputs);
  if (savedCriteria) {
    console.log("Found saved criteria inputs.");
    const criteriaData = JSON.parse(savedCriteria);
    document.querySelectorAll("input[data-i]").forEach((input) => {
      const i = input.dataset.i;
      const j = input.dataset.j;
      const key = `${i}-${j}`;
      if (criteriaData[key] !== undefined) {
        input.value = criteriaData[key];
        // Update reciprocal cell immediately after loading value
        const val = parseFloat(input.value);
        if (!isNaN(val) && val !== 0) {
          const reciprocalCell = document.querySelector(
            `[data-auto="${j}-${i}"]`
          );
          if (reciprocalCell) {
            reciprocalCell.innerText = (1 / val).toFixed(3);
          }
        }
      }
    });
  } else {
    console.log("No saved criteria inputs found.");
  }

  // Muat input alternatif
  const savedAlternatives = localStorage.getItem(storageKeys.alternativeInputs);
  if (savedAlternatives) {
    console.log("Found saved alternative inputs.");
    const alternativesData = JSON.parse(savedAlternatives);
    document.querySelectorAll("input[data-ialt]").forEach((input) => {
      const i = input.dataset.ialt;
      const j = input.dataset.jkrit;
      const key = `${i}-${j}`;
      if (alternativesData[key] !== undefined) {
        input.value = alternativesData[key];
      }
    });
  } else {
    console.log("No saved alternative inputs found.");
  }

  // Muat hasil perhitungan (jika ada)
  const savedResults = localStorage.getItem(storageKeys.results);
  if (savedResults) {
    console.log("Found saved results.");
    try {
      const resultsData = JSON.parse(savedResults);
      displayResults(resultsData); // Tampilkan hasil yang disimpan
    } catch (e) {
      console.error("Error parsing saved results:", e);
      localStorage.removeItem(storageKeys.results); // Hapus data korup
    }
  } else {
    console.log("No saved results found.");
  }
}

// Fungsi untuk menampilkan hasil (dipisahkan agar bisa dipanggil saat load)
function displayResults(resultsData) {
  // Tampilkan hasil kriteria
  if (resultsData.kriteria) {
    document.getElementById("hasil").innerHTML = `
                    <h2><br><br>3. Hasil Bobot Kriteria</h2><br>
                    <table>
                      <tr><th>Kriteria</th><th>Bobot</th></tr>
                      ${kriteria
                        .map(
                          (k, i) =>
                            `<tr><td>${k}</td><td>${resultsData.kriteria.priorities[
                              i
                            ].toFixed(4)}</td></tr>`
                        )
                        .join("")}
                    </table> <br>
                    <p><strong>Lambda Max:</strong> ${resultsData.kriteria.lambdaMax.toFixed(
                      4
                    )}</p>
                    <p><strong>CI:</strong> ${resultsData.kriteria.CI.toFixed(
                      4
                    )},<br> CR: ${resultsData.kriteria.CR.toFixed(4)} -
                    <span style="color:${
                      resultsData.kriteria.CR < 0.1 ? "green" : "red"
                    }">${
      resultsData.kriteria.CR < 0.1 ? "Konsisten" : "Tidak Konsisten"
    }</span></p><br>
                  `;
  } else {
    document.getElementById("hasil").innerHTML = ""; // Kosongkan jika tidak ada data kriteria
  }

  // Tampilkan ranking alternatif
  if (resultsData.alternatif && resultsData.alternatif.ranking) {
    document.getElementById("hasilAlternatif").innerHTML = `
                    <h2>4. Ranking Alternatif</h2>
                    <table> <br>
                      <tr><th>Rank</th><th>Alternatif</th><th>Skor</th></tr>
                      ${resultsData.alternatif.ranking
                        .map(
                          (r, i) =>
                            `<tr><td>${i + 1}</td><td>${
                              r.nama
                            }</td><td>${r.skor.toFixed(4)}</td></tr>`
                        )
                        .join("")}
                    </table>
                  `;
  } else {
    document.getElementById("hasilAlternatif").innerHTML = ""; // Kosongkan jika tidak ada ranking
  }
}

// Fungsi untuk menghapus data dari localStorage dan mereset form
function clearStorage() {
  if (
    confirm(
      "Apakah Anda yakin ingin mereset semua input dan hasil perhitungan?"
    )
  ) {
    localStorage.removeItem(storageKeys.criteriaInputs);
    localStorage.removeItem(storageKeys.alternativeInputs);
    localStorage.removeItem(storageKeys.results);
    console.log("Storage cleared.");
    // Reload halaman untuk kembali ke state awal
    window.location.reload();
  }
}

// --- Modifikasi Pembuatan Tabel ---

// Buat header matriks kriteria
kriteria.forEach((k) => {
  const th = document.createElement("th");
  th.innerText = k;
  thead.appendChild(th);
});

// Buat input perbandingan kriteria
kriteria.forEach((row, i) => {
  const tr = document.createElement("tr");
  const th = document.createElement("th");
  th.innerText = row;
  tr.appendChild(th);

  kriteria.forEach((col, j) => {
    const td = document.createElement("td");
    if (i === j) {
      td.innerHTML = "1";
    } else if (i < j) {
      // Tambahkan event listener oninput untuk menyimpan data
      td.innerHTML = `<input type="number" step="0.01" min="0.01" data-i="${i}" data-j="${j}" oninput="updateReciprocalAndSaveCriteria(this)">`;
    } else {
      td.setAttribute("data-auto", `${i}-${j}`);
      td.innerText = "-"; // Akan diupdate oleh JS
    }
    tr.appendChild(td);
  });
  tbody.appendChild(tr);
});

// Fungsi untuk update nilai resiprokal dan menyimpan input kriteria
function updateReciprocalAndSaveCriteria(inputElement) {
  const i = parseInt(inputElement.dataset.i);
  const j = parseInt(inputElement.dataset.j);
  const val = parseFloat(inputElement.value);

  if (!isNaN(val) && val !== 0) {
    const reciprocalCell = document.querySelector(`[data-auto="${j}-${i}"]`);
    if (reciprocalCell) {
      reciprocalCell.innerText = (1 / val).toFixed(3);
    }
    saveCriteriaInputs(); // Simpan setiap kali input valid diubah
  } else if (val === 0) {
    // Handle jika user memasukkan 0 (tidak valid dalam AHP perbandingan)
    const reciprocalCell = document.querySelector(`[data-auto="${j}-${i}"]`);
    if (reciprocalCell) {
      reciprocalCell.innerText = "Error (1/0)";
    }
    // Mungkin tidak menyimpan jika 0, atau simpan saja apa adanya
    saveCriteriaInputs();
  } else {
    // Handle jika input tidak valid (kosong atau bukan angka)
    const reciprocalCell = document.querySelector(`[data-auto="${j}-${i}"]`);
    if (reciprocalCell) {
      reciprocalCell.innerText = "-"; // Kembali ke default
    }
    saveCriteriaInputs(); // Simpan string kosong atau NaN jika perlu
  }
}

// Buat header tabel alternatif
kriteria.forEach((k) => {
  const th = document.createElement("th");
  th.innerText = k;
  altThead.appendChild(th);
});

// Buat input nilai alternatif
alternatif.forEach((alt, i) => {
  const tr = document.createElement("tr");
  const th = document.createElement("th");
  th.innerText = alt;
  tr.appendChild(th);

  kriteria.forEach((k, j) => {
    const td = document.createElement("td");
    // Tambahkan event listener oninput untuk menyimpan data
    td.innerHTML = `<input type="number" min="1" max="9" data-ialt="${i}" data-jkrit="${j}" oninput="saveAlternativeInputs()">`;
    tr.appendChild(td);
  });
  altTbody.appendChild(tr);
});

// --- Modifikasi Fungsi Hitung AHP ---
function hitungAHP() {
  const n = kriteria.length;
  let matrix = Array.from({ length: n }, () => Array(n).fill(1));
  let isInputValid = true;

  // Ambil nilai dari input dan update matriks serta sel resiprokal
  document.querySelectorAll("input[data-i]").forEach((input) => {
    const i = parseInt(input.dataset.i);
    const j = parseInt(input.dataset.j);
    let val = parseFloat(input.value);

    if (isNaN(val) || val <= 0) {
      alert(
        `Input tidak valid pada perbandingan Kriteria ${kriteria[i]} vs ${kriteria[j]}. Harap masukkan angka positif.`
      );
      input.focus();
      isInputValid = false;
      return; // Hentikan proses jika ada input tidak valid
    }

    matrix[i][j] = val;
    matrix[j][i] = 1 / val;
    // Pastikan sel resiprokal terupdate juga di tampilan
    const reciprocalCell = document.querySelector(`[data-auto="${j}-${i}"]`);
    if (reciprocalCell) {
      reciprocalCell.innerText = (1 / val).toFixed(3);
    }
  });

  if (!isInputValid) return; // Hentikan perhitungan jika ada input kriteria tidak valid

  // Lanjutkan perhitungan bobot kriteria
  const colSums = matrix[0].map((_, j) =>
    matrix.reduce((sum, row) => sum + row[j], 0)
  );
  const norm = matrix.map((row) => row.map((val, j) => val / colSums[j]));
  const priorities = norm.map((row) => row.reduce((a, b) => a + b, 0) / n);

  // Perhitungan lambda max yang lebih stabil
  const weightedSumVector = matrix.map((row, i) =>
    row.reduce((sum, val, j) => sum + val * priorities[j], 0)
  );
  const lambdaMax =
    weightedSumVector.reduce((sum, ws, i) => sum + ws / priorities[i], 0) / n;

  // Check for division by zero in priorities
  if (priorities.some((p) => p === 0 || isNaN(p))) {
    alert(
      "Terjadi kesalahan dalam perhitungan bobot kriteria (prioritas nol atau NaN). Periksa kembali input perbandingan kriteria."
    );
    return;
  }

  const CI = (lambdaMax - n) / (n - 1);
  const RI = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45][n - 1] || 1.49; // Default untuk n > 9
  const CR = RI === 0 ? 0 : CI / RI; // Hindari pembagian dengan nol jika n < 3

  // Kumpulkan hasil kriteria
  const hasilKriteria = {
    priorities: priorities,
    lambdaMax: lambdaMax,
    CI: CI,
    CR: CR,
  };

  // Ambil nilai alternatif
  let nilaiAlternatif = Array.from({ length: alternatif.length }, () =>
    Array(kriteria.length).fill(0)
  );
  let isAltInputValid = true;
  document.querySelectorAll("input[data-ialt]").forEach((input) => {
    const i = parseInt(input.dataset.ialt);
    const j = parseInt(input.dataset.jkrit);
    let val = parseFloat(input.value);

    if (isNaN(val) || val < 1 || val > 9) {
      // Asumsi skala 1-9 Saaty
      alert(
        `Input tidak valid pada Alternatif ${alternatif[i]} untuk Kriteria ${kriteria[j]}. Harap masukkan angka antara 1 dan 9.`
      );
      input.focus();
      isAltInputValid = false;
      return;
    }
    nilaiAlternatif[i][j] = val;
  });

  if (!isAltInputValid) return; // Hentikan perhitungan jika ada input alternatif tidak valid

  // Hitung skor total alternatif
  let totalSkor = nilaiAlternatif.map((row) =>
    row.reduce((sum, val, j) => {
      // Pastikan priorities[j] valid sebelum mengalikan
      const weight = priorities[j] || 0;
      return sum + val * weight;
    }, 0)
  );

  // Buat ranking
  let ranking = alternatif
    .map((alt, i) => ({
      nama: alt,
      skor: totalSkor[i] || 0, // Default ke 0 jika skor NaN
    }))
    .sort((a, b) => b.skor - a.skor);

  // Kumpulkan hasil alternatif
  const hasilAlternatif = {
    ranking: ranking,
  };

  // Gabungkan semua hasil untuk disimpan
  const allResults = {
    kriteria: hasilKriteria,
    alternatif: hasilAlternatif,
  };

  // Tampilkan hasil menggunakan fungsi displayResults
  displayResults(allResults);

  // Simpan hasil ke localStorage
  saveResults(allResults);
}

// --- Panggil fungsi load saat halaman siap ---
// Panggil loadDataFromStorage setelah elemen dibuat
document.addEventListener("DOMContentLoaded", (event) => {
  // Pastikan tabel sudah ter-generate sebelum load
  // (Karena generate tabel ada di script global, seharusnya sudah jalan sebelum DOMContentLoaded)
  loadDataFromStorage();
});

// const tbody = document.querySelector("#matrixInput tbody");
// const thead = document.querySelector("#matrixInput thead tr");
// const altTbody = document.querySelector("#alternatifInput tbody");
// const altThead = document.querySelector("#alternatifInput thead tr");

// // Buat header matriks kriteria
// kriteria.forEach((k) => {
//   const th = document.createElement("th");
//   th.innerText = k;
//   thead.appendChild(th);
// });

// // Buat input perbandingan kriteria
// kriteria.forEach((row, i) => {
//   const tr = document.createElement("tr");
//   const th = document.createElement("th");
//   th.innerText = row;
//   tr.appendChild(th);

//   kriteria.forEach((col, j) => {
//     const td = document.createElement("td");
//     if (i === j) {
//       td.innerHTML = "1";
//     } else if (i < j) {
//       td.innerHTML = `<input type="number" step="0.01" value="1" min="0.01" data-i="${i}" data-j="${j}">`;
//     } else {
//       td.setAttribute("data-auto", `${i}-${j}`);
//       td.innerText = "-";
//     }
//     tr.appendChild(td);
//   });
//   tbody.appendChild(tr);
// });

// // Buat header tabel alternatif
// kriteria.forEach((k) => {
//   const th = document.createElement("th");
//   th.innerText = k;
//   altThead.appendChild(th);
// });

// // Buat input nilai alternatif
// alternatif.forEach((alt, i) => {
//   const tr = document.createElement("tr");
//   const th = document.createElement("th");
//   th.innerText = alt;
//   tr.appendChild(th);

//   kriteria.forEach((k, j) => {
//     const td = document.createElement("td");
//     td.innerHTML = `<input type="number" min="1" max="9" value="5" data-ialt="${i}" data-jkrit="${j}">`;
//     tr.appendChild(td);
//   });
//   altTbody.appendChild(tr);
// });

// // Fungsi Hitung AHP + Ranking
// function hitungAHP() {
//   const n = kriteria.length;
//   let matrix = Array.from(
//     {
//       length: n,
//     },
//     () => Array(n).fill(1)
//   );

//   document.querySelectorAll("input[data-i]").forEach((input) => {
//     const i = parseInt(input.dataset.i);
//     const j = parseInt(input.dataset.j);
//     const val = parseFloat(input.value);
//     matrix[i][j] = val;
//     matrix[j][i] = 1 / val;
//     document.querySelector(`[data-auto="${j}-${i}"]`).innerText = (
//       1 / val
//     ).toFixed(3);
//   });

//   const colSums = matrix[0].map((_, j) =>
//     matrix.reduce((sum, row) => sum + row[j], 0)
//   );
//   const norm = matrix.map((row) => row.map((val, j) => val / colSums[j]));
//   const priorities = norm.map((row) => row.reduce((a, b) => a + b, 0) / n);

//   const lambdaMax =
//     matrix
//       .map(
//         (row, i) =>
//           row.reduce((sum, val, j) => sum + val * priorities[j], 0) /
//           priorities[i]
//       )
//       .reduce((a, b) => a + b, 0) / n;

//   const CI = (lambdaMax - n) / (n - 1);
//   const RI = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45][n - 1] || 1.49;
//   const CR = CI / RI;

//   document.getElementById("hasil").innerHTML = `
// <h2><br><br>3. Hasil Bobot Kriteria</h2><br>
// <table>
// <tr><th>Kriteria</th><th>Bobot</th></tr>
// ${kriteria
//   .map((k, i) => `<tr><td>${k}</td><td>${priorities[i].toFixed(4)}</td></tr>`)
//   .join("")}
// </table>
// <p><strong><br>Lambda Max:</strong> ${lambdaMax.toFixed(4)}</p><br>
// <p><strong>CI:</strong> ${CI.toFixed(4)},<br> CR: ${CR.toFixed(4)} -
// <span style="color:${CR < 0.1 ? "green" : "red"}">${
//     CR < 0.1 ? "Konsisten" : "Tidak Konsisten"
//   }</span></p> <br> <br>
// `;

//   // Alternatif
//   let nilaiAlternatif = Array.from(
//     {
//       length: alternatif.length,
//     },
//     () => Array(kriteria.length).fill(0)
//   );

//   document.querySelectorAll("input[data-ialt]").forEach((input) => {
//     const i = parseInt(input.dataset.ialt);
//     const j = parseInt(input.dataset.jkrit);
//     nilaiAlternatif[i][j] = parseFloat(input.value);
//   });

//   let totalSkor = nilaiAlternatif.map((row) =>
//     row.reduce((sum, val, j) => sum + val * priorities[j], 0)
//   );

//   let ranking = alternatif
//     .map((alt, i) => ({
//       nama: alt,
//       skor: totalSkor[i],
//     }))
//     .sort((a, b) => b.skor - a.skor);

//   document.getElementById("hasilAlternatif").innerHTML = `
// <h2>4. Ranking Alternatif</h2> <br>
// <table>
// <tr><th>Rank</th><th>Alternatif</th><th>Skor</th></tr>
// ${ranking
//   .map(
//     (r, i) =>
//       `<tr><td>${i + 1}</td><td>${r.nama}</td><td>${r.skor.toFixed(
//         4
//       )}</td></tr>`
//   )
//   .join("")}
// </table>
// `;
// }
