<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>

    <p>{{ $name }}</p>

    <div class="alphabet-nav" style="text-align: center; margin-bottom: 20px;">
        @foreach(range('A', 'Z') as $index => $letter)
            @if ($index > 0)
                <!-- Add a hyphen between the letters except for the first letter -->
                <span>-</span>
            @endif
            <a href="#{{ $letter }}" class="alphabet-link" style="text-decoration: none; font-size: 18px; color: #007bff;">{{ $letter }}</a>
        @endforeach
    </div>

    <?php
    $size = count($brands);
    $columns = 3;
    $chunk_size = ceil($size / $columns);
    ?>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            @foreach($brands->chunk($chunk_size) as $chunk)
                <div class="col-md-4">

                    <ul>
                        @foreach($chunk as $brand)

                            <?php
                            $current_first_letter = strtoupper(substr($brand->name, 0, 1));

                            if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                // Add an anchor section for each letter (A-Z)
                                echo '</ul>
                                    <h2 id="' . $current_first_letter . '" style="margin-top: 30px;">' . $current_first_letter . '</h2>
                                    <ul>';
                            }
                            $header_first_letter = $current_first_letter;
                            ?>

                            <li>
                                <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <?php
                unset($header_first_letter);
                ?>
            @endforeach

        </div>

    </div>

</x-layouts.app>
