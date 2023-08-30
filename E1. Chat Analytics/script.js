document.getElementById("analisisTombol").addEventListener("click", async () => {
    const jsonInput = document.getElementById("jsonInput");
    const kataTeratasDiv = document.getElementById("kataTeratas");
    const totalKirim = document.getElementById("totalKirim");
    const totalTerima = document.getElementById("totalTerima");
    const rataPanjangKirim = document.getElementById("rataPanjangKirim");
    const rataPanjangTerima = document.getElementById("rataPanjangTerima");

    if (jsonInput.files.length === 0) {
        alert("Harap pilih berkas JSON.");
        return;
    }

    const berkas = jsonInput.files[0];
    const isiBerkas = await bacaIsiBerkas(berkas);
    const pesan = JSON.parse(isiBerkas);

    const frekuensiKata = {};
    let totalKirimHitung = 0;
    let totalTerimaHitung = 0;
    let totalKirimKarakter = 0;
    let totalTerimaKarakter = 0;

    pesan.forEach(pesan => {
        if (pesan.type === "sent") {
            totalKirimHitung++;
            totalKirimKarakter += pesan.content.length;
        } else if (pesan.type === "received") {
            totalTerimaHitung++;
            totalTerimaKarakter += pesan.content.length;
        }

        const kata = pesan.content.toLowerCase().split(/\s+/);
        kata.forEach(kata => {
            if (kata !== "") {
                if (!frekuensiKata[kata]) {
                    frekuensiKata[kata] = 0;
                }
                frekuensiKata[kata]++;
            }
        });
    });

    const kataTerurut = Object.keys(frekuensiKata).sort((a, b) => frekuensiKata[b] - frekuensiKata[a]);
    const kataTeratas = kataTerurut.slice(0, 5);

    kataTeratasDiv.innerHTML = `<p>Top 5 kata terkirim: "${kataTeratas.join('", "')}".</p>`;
    totalKirim.textContent = `Total pesan terkirim: ${totalKirimHitung}`;
    totalTerima.textContent = `Total pesan diterima: ${totalTerimaHitung}`;
    rataPanjangKirim.textContent = `Rata-rata panjang karakter pesan terkirim: ${Math.round(totalKirimKarakter / totalKirimHitung)} karakter`;
    rataPanjangTerima.textContent = `Rata-rata panjang karakter pesan diterima: ${Math.round(totalTerimaKarakter / totalTerimaHitung)} karakter`;
});

function bacaIsiBerkas(berkas) {
    return new Promise((resolve, reject) => {
        const pembaca = new FileReader();
        pembaca.onload = event => resolve(event.target.result);
        pembaca.onerror = event => reject(event);
        pembaca.readAsText(berkas);
    });
}