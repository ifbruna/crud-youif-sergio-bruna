<div>
    <form action="#" method="post">

        <div>
            <label for="media_tyoe">Tipo de Midia</label>
            <select name="media_type" id="media_type">
                <option value="video">Vídeo</option>
                <option value="audio">Audio</option>
            </select>
        </div>

        <div>
            <label for="media_title">Título:</label>
            <input type="text" name="media_title" id="media_title">
        </div>

        <div>
            <label for="media_imagem">Imagem</label>
            <input type="file" name="media_imagem" id="media_imagem" accept="image/*">
        </div>

        <div>
            <label for="media_file">Faça Upload:</label>
            <input type="file" name="media_file" id="media_file">
        </div>

        <button type="submit">Salvar</button>

    </form>
</div>