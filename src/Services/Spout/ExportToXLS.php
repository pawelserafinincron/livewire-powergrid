<?php

namespace PowerComponents\LivewirePowerGrid\Services\Spout;

use OpenSpout\Common\Entity\Row;
use OpenSpout\Common\Entity\Style\{Color, Style};
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use OpenSpout\Writer\XLSX\Writer;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Services\Contracts\ExportInterface;
use PowerComponents\LivewirePowerGrid\Services\{Export};
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportToXLS extends Export implements ExportInterface
{
    /**
     * @throws \Exception
     */
    public function download(Exportable|array $exportOptions): BinaryFileResponse
    {
        $deleteFileAfterSend = data_get($exportOptions, 'deleteFileAfterSend');
        $this->striped       = data_get($exportOptions, 'striped');
        $this->build();

        return response()
            ->download(storage_path($this->fileName . '.xlsx'))
            ->deleteFileAfterSend($deleteFileAfterSend);
    }

    /**
     * @throws WriterNotOpenedException
     * @throws IOException
     */
    public function build(): void
    {
        $data = $this->prepare($this->data, $this->columns);

        $writer  = new Writer();
        $writer->openToFile(storage_path($this->fileName . '.xlsx'));

        $style = (new Style())
            ->setFontBold()
            ->setFontName('Arial')
            ->setFontSize(12)
            ->setFontColor(Color::BLACK)
            ->setShouldWrapText(false)
            ->setBackgroundColor('d0d3d8');

        $row = Row::fromValues($data['headers'], $style);

        $writer->addRow($row);

        $default = (new Style())
            ->setFontName('Arial')
            ->setFontSize(12);

        $gray = (new Style())
            ->setFontName('Arial')
            ->setFontSize(12)
            ->setBackgroundColor($this->striped);

        /** @var array<string> $row */
        foreach ($data['rows'] as $key => $row) {
            if (count($row)) {
                if ($key % 2 && $this->striped) {
                    $row = Row::fromValues($row, $gray);
                } else {
                    $row = Row::fromValues($row, $default);
                }
                $writer->addRow($row);
            }
        }

        $writer->close();
    }
}
