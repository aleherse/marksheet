<?php

namespace spec\Arkschools\DataInputSheet;

use Arkschools\DataInputSheet\Bridge\Symfony\Entity\Cell;
use Arkschools\DataInputSheet\Column;
use Arkschools\DataInputSheet\Spine;
use PhpSpec\ObjectBehavior;

class ViewSpec extends ObjectBehavior
{
    function let(Spine $spine, Column $brand, Column $model, Cell $cell)
    {
        $cell->getColumn()->willReturn('brand');
        $cell->getSpine()->willReturn('renault-11');
        $model->getId()->willReturn('model');
        $brand->getId()->willReturn('brand');
        $spine->getHeader()->willReturn('Cars');
        $spine->getSpine()->willReturn(
            [
                'lexus-is-200'    => 'Lexus IS 200 1999 - 2005',
                'audi-80'         => 'Audi 80 1.6 E 1992 - 1994',
                'hyundai-i20'     => 'Hyundai i20 1.25 i-Motion 2010 - 2012',
                'renault-fluence' => 'Renault Fluence Z.E. Expression 2011 - 2015',
                'hyundai-i40'     => 'Hyundai i40 1.6 GDI Blue i-Motion 2011 - 2014',
            ]
        );

        $spine->getEntity()->willReturn(null);
        $spine->getEntitySpineField()->willReturn(null);
        $spine->getTableName()->willReturn(null);

        $this->beConstructedWith('cars', 'Brand and model', $spine, [$brand, $model]);
    }

    function it_has_an_id()
    {
        $this->getId()->shouldReturn('brand-and-model');
    }

    function it_has_a_title()
    {
        $this->getTitle()->shouldReturn('Brand and model');
    }

    function it_has_a_spine_header()
    {
        return $this->getSpineHeader()->shouldReturn('Cars');
    }

    function it_has_spine_data()
    {
        $this->getSpine()->shouldReturn(
            [
                'lexus-is-200'    => 'Lexus IS 200 1999 - 2005',
                'audi-80'         => 'Audi 80 1.6 E 1992 - 1994',
                'hyundai-i20'     => 'Hyundai i20 1.25 i-Motion 2010 - 2012',
                'renault-fluence' => 'Renault Fluence Z.E. Expression 2011 - 2015',
                'hyundai-i40'     => 'Hyundai i40 1.6 GDI Blue i-Motion 2011 - 2014',
            ]
        );
    }

    function it_has_columns(Column $brand, Column $model)
    {
        $this->getColumns()->shouldReturn(['brand' => $brand, 'model' => $model]);
    }

    function it_retrieves_a_column(Column $model)
    {
        $this->getColumn('model')->shouldReturn($model);
    }

    function it_has_empty_content_if_not_previously_loaded()
    {
        $this->getContent('brand', 'lexus-is-200')->shouldReturn(null);
    }
}
