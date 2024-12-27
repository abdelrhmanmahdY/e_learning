<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"
        integrity="sha512-U5C477Z8VvmbYAoV4HDq17tf4wG6HXPC6/KM9+0/wEXQQ13gmKY2Zb0Z2vu0VNUWch4GlJ+Tl/dfoLOH4i2msw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            color: #eee;
        }

        button {
            cursor: pointer;
            padding: 2px 5px;
            color: #ccc;
            background: transparent;
            border: none;
            outline: none;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: #171717;
        }

        main {
            width: 100%;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;

        }

        main h3 {
            text-align: center;
            width: 100%;
            word-spacing: 0.5rem;
            font-size: 2rem;
            color: #bbbbbb;
        }

        .pdf-viewer {
            background-color: #333;
            background-color: #fff;
            margin: auto;
        }

        .hidden {
            display: none;
        }

        footer {
            position: sticky;
            bottom: 0;
            height: 10vh;
            background-color: #000000;
        }

        .pagination {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: #eee;
            font-size: 1.4rem;
        }

        .pagination span {
            font-size: 1.1rem;
            margin: 0 10px;
        }

        .pagination button {
            font-size: 1.5rem;
        }

        button:active>* {
            color: #8d8d8d;
        }

        footer ul {
            list-style-type: none;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        footer ul li:first-child {
            margin-left: 20px;
        }

        footer ul li:last-child {
            margin-right: 20px;
        }

        #zoomValue {
            display: inline-block;
            font-size: 0.9rem;
            width: 60px;
            vertical-align: center;
        }

        #openPDF {
            font-size: 1.2rem;
            padding: 2px 5px;
            font-weight: 700;
            color: #eee;
        }
    </style>
    <title>PDF Viewer</title>
</head>

<body>
    <main>
        <h3>Open a PDF file</h3>
        <canvas class="pdf-viewer hidden">

        </canvas>
    </main>
    <footer>
        <ul>

            <li class="pagination">
                <button id="previous"><i class="fas fa-arrow-alt-circle-left"></i></button>
                <span id="current_page">0 of 0</span>
                <button id="next"><i class="fas fa-arrow-alt-circle-right"></i></button>
            </li>

            <li>
                <span id="zoomValue">150%</span>
                <input type="range" id="zoom" name="cowbell" min="100" max="300" value="150"
                    step="50">
            </li>
        </ul>
    </footer>
    <script>
        const zoomButton = document.getElementById(" zoom");
        const currentPage = document.getElementById("current_page");
        const viewer = document.querySelector(".pdf-viewer");
        let currentPDF = {};

        function resetCurrentPDF() {
            currentPDF = {
                file: null,
                countOfPages: 0,
                currentPage: 1,
                zoom: 1.5,
            };
        }
        loadPDF(); //url of pdf
        zoomButton.addEventListener("input", () => {
            if (currentPDF.file) {
                document.getElementById("zoomValue").innerHTML = zoomButton.value + "%";
                currentPDF.zoom = parseInt(zoomButton.value) / 100;
                renderCurrentPage();
            }
        });

        document.getElementById("next").addEventListener("click", () => {
            const isValidPage = currentPDF.currentPage < currentPDF.countOfPages;
            if (isValidPage) {
                currentPDF.currentPage += 1;
                renderCurrentPage();
            }
        });

        document.getElementById("previous").addEventListener("click", () => {
            const isValidPage = currentPDF.currentPage - 1 > 0;
            if (isValidPage) {
                currentPDF.currentPage -= 1;
                renderCurrentPage();
            }
        });

        function loadPDF() {
            const pdfPath = "{{ asset('assets/' . $pdf) }}"; // Use Laravel's asset helper
            const pdfFile = pdfjsLib.getDocument(pdfPath);
            resetCurrentPDF();
            pdfFile.promise.then((doc) => {
                currentPDF.file = doc;
                currentPDF.countOfPages = doc.numPages;
                viewer.classList.remove("hidden");
                document.querySelector("main h3").classList.add("hidden");
                renderCurrentPage();
            })
        };

        function renderCurrentPage() {
            currentPDF.file.getPage(currentPDF.currentPage).then((page) => {
                var context = viewer.getContext("2d");
                var viewport = page.getViewport({
                    scale: currentPDF.zoom
                });
                viewer.height = viewport.height;
                viewer.width = viewport.width;

                var renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                };
                page.render(renderContext);
            });
            currentPage.innerHTML =
                currentPDF.currentPage + " of " + currentPDF.countOfPages;
        }
    </script>
</body>

</html>
