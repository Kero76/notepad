<?php
    /**
 * Notepad.
 * Copyright (C) 2017 Nicolas GILLE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

    declare(strict_types=1);

    namespace Notepad\Form;

    use Notepad\Entity\Label;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class LabelType
     *
     * @author Nicolas GILLE
     * @package Notepad\Form
     * @since 0.1
     * @version 1.0
     */
    class LabelType extends AbstractType {

        /**
         * Build form on twig template.
         *
         * @param \Symfony\Component\Form\FormBuilderInterface $builder
         *  Interface to build form.
         * @param array $options
         *  Options to build form.
         *
         * @since 1.0
         * @version 1.0
         */
        public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder
                ->add(
                    'title',
                    TextType::class,
                    array(
                        'label_format' => 'title_label',
                        'required' => true,
                        'constraints' => array(
                            new NotBlank(),
                            new Length(
                                array(
                                    'min' => 1,
                                    'max' => 255,
                                )
                            ),
                        ),
                    )
                );
        }

        /**
         * Configure option for form.
         *
         * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
         * @since 0.1
         * @version 1.0
         */
        public function configureOptions(OptionsResolver $resolver) {
            $resolver->setDefaults(array(
                'data_class' => Label::class,
            ));
        }
    }
